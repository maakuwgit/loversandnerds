class Breakpoints {
	constructor(small, medium, large, xlarge)	{
		this.small = ( !this.small ? 420 : small );
		this.medium = ( !this.medium ? 768 : medium );
		this.large = ( !this.large ? 1024 : large );
		this.xlarge = ( !this.xlarge ? 1600 : xlarge );
	}
}