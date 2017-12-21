<?php
/*
Plugin Name: Lovers&Nerds Tweets Widget
Plugin URI: http://wordpress.org/extend/plugins/latest-tweets-widget/
Description: Shows the latest, or (later) multiple tweets via shortcode
Author: MaakuW, based on Tim Whitlock's work
Version: 0.1
Author URI: http://timwhitlock.info/
Text Domain: twitter-api
Domain Path: /api/lang/
*/



/**
 * Pull latest tweets with some caching of raw data.
 * @param string account whose tweets we're pulling
 * @param int number of tweets to get and display
 * @param bool whether to show retweets
 * @param bool whether to show at replies
 * @return array blocks of html expected by the widget
 */
function nu_tweets_render( $screen_name, $count, $rts, $ats, $pop = 0 ){
    try {
        if( ! function_exists('twitter_api_get') ){
            require_once dirname(__FILE__).'/api/twitter-api.php';
            twitter_api_load_textdomain();
        }
        // Check configuration before use
        if( ! twitter_api_configured() ){
            throw new Exception( __('Plugin not fully configured','twitter-api') );
        }
        // Build API params for "statuses/user_timeline" // https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
        $trim_user = false;
        $include_rts = ! empty($rts);
        $exclude_replies = empty($ats);
        $params = compact('exclude_replies','include_rts','trim_user','screen_name');
        // Stripping tweets means we may get less than $count tweets.
        // we'll keep going until we get the amount we need, but may as well get more each time.
        if( $exclude_replies || ! $include_rts || $pop ){
            $params['count'] = 100;
        }
        else {
            $params['count'] = max( $count, 2 );
        }
        // pull tweets until we either have enough, or there are no more
        $tweets = array();
        $profile_banner = twitter_api_get('users/profile_banner', $params );
        while( $batch = twitter_api_get('statuses/user_timeline', $params ) ){
            $max_id = null;
            foreach( $batch as $tweet ){
                if( isset($params['max_id']) && $tweet['id_str'] === $params['max_id'] ){
                    // previous max included in results, even though docs say it won't be
                    continue;
                }
                $max_id = $tweet['id_str'];
                if( ! $include_rts && preg_match('/^(?:RT|MT)[ :\-]*@/i', $tweet['text']) ){
                    // skipping manual RT
                    continue;
                }
                if( $pop > ( $tweet['retweet_count'] + $tweet['favorite_count'] ) ){
                    // skipping tweets not deemed popular enough
                    continue;
                }
                $tweets[] = $tweet;
            }
            if( isset($tweets[$count]) ){
                $tweets = array_slice( $tweets, 0, $count );
                break;
            }
            if( ! $max_id ){
                // infinite loop would occur if user had only tweeted once, ever.
                break;
            }
            $params['max_id'] = $max_id;
        }
        // Fix Wordpress's broken timezone implementation
        $os_timezone = date_default_timezone_get() or $os_timezone = 'UTC';
        $wp_timezone = get_option('timezone_string') or $wp_timezone = $os_timezone;
        if( $os_timezone !== $wp_timezone ){
            date_default_timezone_set( $wp_timezone );
        }
        // Let theme disable or override emoji rendering
        $emoji_callback = apply_filters('nu_tweets_emoji_callback', 'twitter_api_replace_emoji_callback' );
        // render each tweet as a block of html for the widget list items
        $rendered = array();
        foreach( $tweets as $tweet ){
            extract( $tweet );
            $handle = $user['screen_name'] or $handle = $screen_name;
            $link = esc_html( 'http://twitter.com/'.$handle.'/status/'.$id_str);
            // render nice datetime, unless theme overrides with filter
            $date = apply_filters( 'nu_tweets_render_date', $created_at );
            if( $date === $created_at ){
                function_exists('twitter_api_relative_date') or twitter_api_include('utils');
                $time = strtotime( $created_at );
                $date = esc_html( twitter_api_relative_date($time) );
                $date = '<time datetime="'.date_i18n( 'g:i A - j M Y', $time ).'">'.date_i18n( 'g:i A - j M Y', $time ).'</time>';
            }
            // handle original retweet text as RT may be truncated
            if( $include_rts && isset($retweeted_status) && preg_match('/^RT\s+@[a-z0-9_]{1,15}[\s:]+/i', $text, $prefix ) ){
                $text = $prefix[0].$retweeted_status['text'];
                unset($retweeted_status);
            }
            // render and linkify tweet, unless theme overrides with filter
            $html = apply_filters('nu_tweets_render_text', $text );
            if( $html === $text ){
                if( ! function_exists('twitter_api_html') ){
                    twitter_api_include('utils');
                }
                // htmlify tweet, using entities if we can
                if( isset($entities) && is_array($entities) ){
                    $html = twitter_api_html_with_entities( $text, $entities );
                    unset($entities);
                }
                else {
                    $html = twitter_api_html( $text );
                }
                // render emoji, unless filtered out
                if( $emoji_callback ){
                    $html = twitter_api_replace_emoji( $html, $emoji_callback );
                }
            }
            // piece together the whole tweet, allowing override
            $final = apply_filters('nu_tweets_render_tweet', $html, $date, $link, $tweet );
            if( $final === $html ){
                $final = '<p class="tweet-text">'.$html.'</p>'.$date;
            }
            $rendered[] = $final;
        }
        // put altered timezone back
        if( $os_timezone !== $wp_timezone ){
            date_default_timezone_set( $os_timezone );
        }
        return $rendered;
    }
    catch( Exception $Ex ){
        return array( '<p class="tweet-text"><strong>Error:</strong> '.esc_html($Ex->getMessage()).'</p>' );
    }
} 



/**
 * Render tweets as HTML anywhere
 * @param string $screen_name Twitter handle
 * @param int $num Number of tweets to show, defaults to 5
 * @param bool $rts Whether to show Retweets, defaults to true
 * @param bool $ats Whether to show 'at' replies, defaults to true
 * @return string HTML <div> element containing a list
 */
function nu_tweets_render_html( $screen_name = 'loversandnerds', $num = 5, $rts = true, $ats = true, $pop = 0 ){
    $items = nu_tweets_render( $screen_name, $num, $rts, $ats, $pop );
    $output = '';
    $params = compact('screen_name');
		$profile_banner = twitter_api_get('users/profile_banner', $params );
		$user = twitter_api_get('users/lookup', $params );
		$profile_image = $user[0]["profile_image_url"];
    if( is_array($items) ){    
	    $output = '<aside id="twitter-feed" class="social-widget fixed small-12 medium-6 large-3" data-background>';
		    $output .= '<div class="feature">';
			    $output .= '<img class="show-for-xlarge" src="'.$profile_banner["sizes"]["web_retina"]["url"].'">';
			    $output .= '<img class="show-for-large-only" src="'.$profile_banner["sizes"]["web"]["url"].'">';
			    $output .= '<img class="hide-for-large" src="'.$profile_banner["sizes"]["mobile_retina"]["url"].'">';
		    $output .= '</div>'; 
				$output .= apply_filters( 'nu_tweets_render_before', '' );
				$output .= '<figure><div class="absolute"><img alt="" src="' . $profile_image . '"></div>';
				$output .= '<figcaption><p>' . $user[0]["description"] . '</p></figcaption></figure>';
				$output .= '<dl class="row tweets">';
	      foreach($items as $item) {
					$tweet = substr($item, strpos($item, '<p'), strpos($item, '</p'));
					$details = substr($item, strpos($item, '<time'));
						$output .= '<dt class="column"><p><a target="_blank" href="'. get_option('nu_setting_social_twitter_href') . '">@' . $screen_name . '</a>';
						$output .= '<br><small class="block">' . $details . '</small>';
						$output .= '</p></dt>';
						$output .= '<dd class="column">' . $tweet . '</dd>';
				}
				$output .= '</dl>';
				$output .= apply_filters( 'nu_tweets_render_after', '' );
			$output .= '</aside>';
    	return $output;
    
    }else{
	    return false;
	  }
}

 
  
/**
 * latest tweets widget class
 */

function nu_tweets_shortcode( $atts ){
    $screen_name = isset($atts['user']) ? trim($atts['user'],' @') : 'loversandnerds';
    $num = isset($atts['max']) ? (int) $atts['max'] : 5;
    return nu_tweets_render_html( $screen_name, $num, true, false );
}

add_shortcode( 'nu_tweets', 'nu_tweets_shortcode' );



if( is_admin() ){
    if( ! function_exists('twitter_api_get') ){
        require_once dirname(__FILE__).'/api/twitter-api.php';
    }
    // extra visibility of API settings link
    function nu_tweets_plugin_row_meta( $links, $file ){
        if( false !== strpos($file,'/latest-tweets.php') ){
            $links[] = '<a href="options-general.php?page=twitter-api-admin"><strong>'.esc_attr__('Connect to Twitter','twitter-api').'</strong></a>';
        } 
        return $links;
    }
    add_action('plugin_row_meta', 'nu_tweets_plugin_row_meta', 10, 2 );
}

