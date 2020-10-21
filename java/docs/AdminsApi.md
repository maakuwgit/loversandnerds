# AdminsApi

All URIs are relative to *https://virtserver.swaggerhub.com/maakuwgit/gm-leadgen-client-typescript/1.0.0*

Method | HTTP request | Description
------------- | ------------- | -------------
[**addInventory**](AdminsApi.md#addInventory) | **POST** /inventory | adds an inventory item

<a name="addInventory"></a>
# **addInventory**
> addInventory(body)

adds an inventory item

Adds an item to the system

### Example
```java
// Import classes:
//import io.swagger.client.ApiException;
//import io.swagger.client.api.AdminsApi;


AdminsApi apiInstance = new AdminsApi();
InventoryItem body = new InventoryItem(); // InventoryItem | Inventory item to add
try {
    apiInstance.addInventory(body);
} catch (ApiException e) {
    System.err.println("Exception when calling AdminsApi#addInventory");
    e.printStackTrace();
}
```

### Parameters

Name | Type | Description  | Notes
------------- | ------------- | ------------- | -------------
 **body** | [**InventoryItem**](InventoryItem.md)| Inventory item to add | [optional]

### Return type

null (empty response body)

### Authorization

No authorization required

### HTTP request headers

 - **Content-Type**: application/json
 - **Accept**: Not defined

