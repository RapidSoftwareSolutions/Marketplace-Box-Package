[![](https://scdn.rapidapi.com/RapidAPI_banner.png)](https://rapidapi.com/package/Box/functions?utm_source=RapidAPIGitHub_BoxFunctions&utm_medium=button&utm_content=RapidAPI_GitHub)

# Box Package
Connect to the Box Cloud Storage API to manage, share, and upload files to the cloud. Test an API call in your browser and export the code snippet into your app.
* Domain: [box.com](https://box.com)
* Credentials: clientId, clientSecret

## How to get credentials:
1. Get authorization code for this [instruction](https://developer.box.com/reference#authorize).
2. Make request to getAccessToken method.


## Box.getAccessToken
Returns access tokens. An access token is a data string that enables Box to verify that a request belongs to an authorized session. In the normal order of operations you will begin by requesting authentication from the Box authorize endpoint and Box will send you an authorization code. You will then send the authorization code to the token endpoint in a request for an access token. You can then use the returned access token to make Box API calls.

| Field       | Type  | Description
|-------------|-------|----------
| code        | String| The authorization code returned by Box in response to a successfull authentication request.
| clientId    | credentials| The client ID of the application requesting authentication. To get the client ID for your application, log in to your Box developer console and click the Edit Application link for the application you're working with. In the OAuth 2 Parameters section of the configuration page, find the item labeled
| clientSecret| credentials| The client secret of the application requesting authentication. To get the client secret for your application, log in to your Box developer console and click the Edit Application link for the application you're working with. In the OAuth 2 Parameters section of the configuration page, find the item labeled

## Box.revokeAccessToken
Revoke endpoint, the endpoint that revokes access tokens, or to put it another way, the endpoint that ends sessions, logging users out.

| Field       | Type  | Description
|-------------|-------|----------
| token       | String| An ```access token``` or ```refresh token``` supplied by Box in response to a token request. When either token is supplied with this request, both will be revoked.
| clientId    | credentials| The client ID of the application requesting authentication. To get the client ID for your application, log in to your Box developer console and click the Edit Application link for the application you're working with. In the OAuth 2 Parameters section of the configuration page, find the item labeled
| clientSecret| credentials| The client secret of the application requesting authentication. To get the client secret for your application, log in to your Box developer console and click the Edit Application link for the application you're working with. In the OAuth 2 Parameters section of the configuration page, find the item labeled

## Box.getFileInfo
Get information about a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| fields     | String| Comma-separated list of fields to include in the response

## Box.downloadFile
Retrieves the actual data of the file. An optional version parameter can be set to download a previous version of the file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| version    | String| Optional file version ID to download (defaults to the current version)
| range      | String| The range value in bytes. Format should be ```bytes={start_range}-{end_range}```
| boxApi     | String| Use the format ```shared_link=SHARED_LINK_URL``` or ```shared_link=SHARED_LINK_URL&shared_link_password=PASSWORD```

## Box.uploadFile
Use the Upload API to allow users to add a new file. The user can then upload a file by specifying the destination folder for the file. If the user provides a file name that already exists in the destination folder, the user will receive an error.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| file       | File  | Uploaded file
| parentId   | String| The ID of the parent folder. Use ```0``` for the root folder.

## Box.uploadFileVersion
Uploading a new file version is performed in the same way as uploading a file. This method is used to upload a new version of an existing file in a user’s account. Similar to regular file uploads, these are performed as multipart form uploads.

| Field      | Type                | Description
|------------|---------------------|----------
| accessToken| String              | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String              | File Id
| file       | File                | Uploaded file
| name       | String| New file name

## Box.verifyFileAcceptance
Method description

| Field      | Type                | Description
|------------|---------------------|----------
| accessToken| String              | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| name       | String| File name
| parentId   | String              | The ID of the parent folder. Use ```0``` for the root folder.
| size       | String              | The size of the file in bytes

## Box.updateFileInfo
Update the information about a file, including renaming or moving the file.

| Field                           | Type                            | Description
|---------------------------------|---------------------------------|----------
| accessToken                     | String                          | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId                          | String                         | File Id
| name                            | String| The new name for the file
| description                     | String| The new description for the file
| parentId                        | String                          | The ID of the parent folder. Use '0' for the root folder.
| sharedLinkAccess                | String                          | The level of access. Can be ```open``` ('People with the link'), ```company``` ('People in your company'), or ```collaborators``` ('People in this folder'). If you omit this field then the access level will be set to the default access level specified by the enterprise admin.
| sharedLinkPassword              | String                          | The password required to access the shared link. Set to ```null``` to remove the password.
| sharedLinkUnsharedAt            | String                          | The date-time that this link will become disabled. This field can only be set by users with paid accounts.
| sharedLinkPermissionsCanDownload| String                          | Whether the shared link allows downloads. Can only be set with access levels ```open``` and ```company``` (not collaborators).
| tags                            | String                          | All tags attached to this file. To add/remove a tag to/from a file, you can first get the file’s current tags (be sure to specify ?fields=tags, since the tags field is not returned by default); then modify the list as required; and finally, set the file’s entire list of tags.

## Box.deleteFile
Move a file to the trash.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id

## Box.copyFile
Copy a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| parentId   | String| The ID of the destination folder
| name       | String| An optional new name for the file

## Box.lockFile
Lock a file.

| Field                  | Type   | Description
|------------------------|--------|----------
| accessToken            | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId                 | String | File Id
| lockExpiresAt          | String | The time the lock expires
| lockIsDownloadPrevented| Boolean| Whether or not the file can be downloaded while locked

## Box.unlockFile
Unlock a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id

## Box.getFileThumbnail
Get a thumbnail image for a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| minHeight  | Number| The minimum height of the thumbnail
| minWidth   | Number| The minimum width of the thumbnail
| maxHeight  | Number| The maximum height of the thumbnail
| maxWidth   | Number| The maximum width of the thumbnail

## Box.getFileEmbedLink
Get a URL for creating an embedded preview session.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id

## Box.getFileCollaborations
Get all of the collaborations on a file (i.e. all of the users that have access to that file).

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| fields     | String| Comma-separated list of fields to include in the response
| marker     | String| The position marker at which to begin the response
| limit      | Number| The maximum number of items to return

## Box.getFileComments
Get all of the comments on a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| fields     | String| Comma-separated list of fields to include in the response
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return

## Box.getFileTasks
Get all of the tasks for a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| fields     | String| Comma-separated list of fields to include in the response
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 1,000 and the maximum is 1,000.

## Box.getFileVersions
Get information on prior versions of a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| fields     | String| Comma-separated list of fields to include in the response
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return

## Box.promoteFileVersion
Copy a previous file version and make it the current version of the file. This create a copy of the old file version and puts it on the top of the versions stack. The file will have the exact same contents, the same SHA-1/etag, and the same name as the original. Other properties such as comments do not get updated to their former values.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| fields     | String| Comma-separated list of fields to include in the response

## Box.deleteOldFileVersion
Discards a file version to the trash.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File Id
| id         | String| The ID of the file version.

## Box.getFolderInfo
Get information about a folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder Id. The root folder of a Box account is always represented by the ID ```0```.
| fields     | String| Comma-separated list of fields to include in the response

## Box.getFolderItems
Gets all of the files, folders, or web links contained within this folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder Id
| fields     | String| Comma-separated list of fields to include in the response
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.createFolder
Create a new folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields     | String| Comma-separated list of fields to include in the response
| name       | String| The desired name for the folder
| parentId   | String| The ID of the parent folder

## Box.updateFolder
Create a new folder.

| Field                           | Type   | Description
|---------------------------------|--------|----------
| accessToken                     | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId                        | String | Folder Id
| fields                          | String | Comma-separated list of fields to include in the response
| name                            | String | The desired name for the folder
| description                     | String | The description of the folder
| parentId                        | String | The ID of the parent folder
| sharedLinkAccess                | String | The level of access. Can be ```open``` ('People with the link'), ```company``` ('People in your company'), or ```collaborators``` ('People in this folder'). If you omit this field then the access level will be set to the default access level specified by the enterprise admin.
| sharedLinkPassword              | String | The password required to access the shared link. Set to ```null``` to remove the password.
| sharedLinkUnsharedAt            | String | The date-time that this link will become disabled. This field can only be set by users with paid accounts.
| sharedLinkPermissionsCanDownload| Boolean| Whether the shared link allows downloads. For shared links on folders, this also applies to any items in the folder. Can only be set with access levels ```open``` and ```company``` (not ```collaborators```)
| ownedById                       | String | The ID of the user (should be your own user ID)
| syncState                       | String | Whether Box Sync clients will sync this folder. Values of synced or not_synced can be sent, while partially_synced may also be returned.
| tags                            | String | All tags attached to this folder. To add/remove a tag to/from a folder, you can first get the folder’s current tags (be sure to specify ```?fields=tags```, since the tags field is not returned by default); then modify the list as required; and finally, set the folder’s entire list of tags.

## Box.deleteFolder
Move a folder to the trash. The recursive parameter must be included in order to delete folders that aren't empty.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String | Folder id
| recursive  | Boolean| Whether to delete this folder if it has items inside of it.

## Box.copyFolder
Used to create a copy of a folder in another folder. The original version of the folder will not be altered.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder id
| parentId   | String| The ID of the destination folder
| fields     | String| Comma-separated list of fields to include in the response
| name       | String| An optional new name for the folder

## Box.getFolderCollaborations
Use this to get a list of all the collaborations on a folder i.e. all of the users that have access to that folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder id
| fields     | String| Comma-separated list of fields to include in the response

## Box.getFileSharedLink
Get the shared link for a file or folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| The ID of the file or folder
| endpoint   | String| ```files``` or ```folders```

## Box.createFileSharedLink
Create the shared link for a file or folder.

| Field                           | Type   | Description
|---------------------------------|--------|----------
| accessToken                     | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| id                              | String | The ID of the file or folder
| endpoint                        | String | ```files``` or ```folders```
| sharedLinkAccess                | String | The level of access. Can be ```open``` ('People with the link'), ```company``` ('People in your company'), or ```collaborators``` ('People in this folder'). If you omit this field then the access level will be set to the default access level specified by the enterprise admin.
| sharedLinkPassword              | String | The password required to access the shared link. Set to ```null``` to remove the password.
| sharedLinkUnsharedAt            | String | The date-time that this link will become disabled. This field can only be set by users with paid accounts.
| sharedLinkPermissionsCanDownload| Boolean| Whether the shared link allows downloads. For shared links on folders, this also applies to any items in the folder. Can only be set with access levels open and company (not collaborators).

## Box.updateFileSharedLink
Update the shared link for a file or folder.

| Field                           | Type   | Description
|---------------------------------|--------|----------
| accessToken                     | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| id                              | String | The ID of the file or folder
| endpoint                        | String | ```files``` or ```folders```
| sharedLinkAccess                | String | The level of access. Can be ```open``` ('People with the link'), ```company``` ('People in your company'), or ```collaborators``` ('People in this folder'). If you omit this field then the access level will be set to the default access level specified by the enterprise admin.
| sharedLinkPassword              | String | The password required to access the shared link. Set to null to remove the password.
| sharedLinkUnsharedAt            | String | The date-time that this link will become disabled. This field can only be set by users with paid accounts.
| sharedLinkPermissionsCanDownload| Boolean| Can be open or collaborators

## Box.getSharedItem
Use this API to obtain the ID of a file or folder from a shared link URL. Pass the URL (and password, if needed) in the BoxApi header. Once you have the ID of the file or folder, you can call any API to access that file or folder a long as you also pass the BoxApi header to those APIs. The header must be passed in each API call since your account would not otherwise have permission to access the shared item. Passing the shared link URL validates that the item was shared with you (e.g. via email or any other channel).

| Field             | Type  | Description
|-------------------|-------|----------
| accessToken       | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| sharedLinkUrl     | String| Url of shared link
| sharedLinkPassword| String| Password of shared link

## Box.getTrashedItems
Gets the files, folders and web links that are in the user's trash.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields     | String| Comma-separated list of fields to include in the response
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getSingleTrashedItem
Get an item that has been moved to the trash.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| id         | String| The ID of the file, folder or web link
| endpoint   | String| ```files```, ```folders``` or ```web_links```
| fields     | String| Comma-separated list of fields to include in the response

## Box.restoreTrashedItem
Restores an item that has been moved to the trash.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| id         | String| The ID of the file, folder or web link
| endpoint   | String| ```files```, ```folders``` or ```web_links```
| fields     | String| Comma-separated list of fields to include in the response
| parentId   | String| The ID of the new parent folder. Only used if the previous parent folder no longer exists or the user doesn't have permission to restore the item there.
| name       | String| The new name for this item. Only used if the item can't be restored with its previous name due to a conflict.

## Box.permanentlyDeleteItem
Permanently delete an item that is in the trash. The item will no longer exist in Box. This action cannot be undone.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| id         | String| The ID of the file, folder or web link
| endpoint   | String| ```files```, ```folders``` or ```web_links```

## Box.searchContent
The search endpoint provides a powerful way to find Box content. Use the parameters described in this section to control what you search for.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| query            | String| The string to search for. Box matches the search string against object names, descriptions, text contents of files, and other data.
| scope            | String| The scope on which you want search. Can be ```user_content``` for a search limited to the current user or ```enterprise_content``` to search an entire enterprise.
| fileExtensions   | String| Limit searches to specific file extensions like ```pdf```,```png```, or ```doc```. The value can be a single file extension or a comma-delimited list of extensions. For example: ```png,md,pdf```
| createdAtRange   | String| The date when the item was created. Specify the date range using RFC3339 timestamps separated by a comma. For example: `2014-05-15T13:35:01-07:00,2014-05-17T13:35:01-07:00. Either the beginning date or the ending date may be empty, but the separating comma is required. For example, if you omit the beginning date, then the ending date must begin with a comma.
| updatedAtRange   | String| The date when the item was updated. Specify the date range using RFC3339 timestamps separated by a comma. For example: ```2014-05-15T13:35:01-07:00,2014-05-17T13:35:01-07:00```. Either the beginning date or the ending date may be empty, but the separating comma is required. For example, if you omit the beginning date, then the ending date must begin with a comma.
| sizeRange        | String| Return only files within a stated size range. Specify the range in bytes with lower and upper bounds separated by a comma, like so:```lower_bound_size,upper_bound_size```, where 1MB is 1,000,000 bytes. You can specify only the lower bound if you end this parameter with a comma. You can specify only the upper bound by placing a comma at the beginning of the number.
| ownerUserIds     | String| Search for objects by owner. Requires a user ID or a set of comma-delimited user IDs, like so: user_id_1,user_id_2
| ancestorFolderIds| String| Search for the contents of specific folders (and folders within them). Requires a folder ID or a set of comma-delimited folder IDs, like so: folder_id_1,folder_id_2
| contentTypes     | String| Search for objects of specified content types. The types can be name, description, file_content, comments, or tags. Requires a content type or a set of comma-delimited content_types, like so: content_type_1,content_type_2
| type             | String| The type of objects you want to include in the search results. The type can be file, folder, or web_link
| trashContent     | String| Controls whether to search in the trash. The value can be ```trashed_only``` or ```non_trashed_only```. Searches without this parameter default to searching ```non_trashed_only```
| fields           | String| Comma-separated list of fields to include in the response
| offset           | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit            | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getMetadataTemplate
Get information about a metadata template.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| scope      | String| The scope of the object. Global and enterprise scopes are supported. The Global scope contains the properties template, while the enterprise scope pertains to custom template within the enterprise.
| template   | String| A unique identifier for the template. The identifier must be unique across the scope of the enterprise to which the metadata template is being applied. The character limit is 64 and is validated by this regex: ```^[a-zA-Z_][-a-zA-Z0-9_]*$```

## Box.createMetadataTemplate
Create a new metadata template with the specified schema.

| Field           | Type   | Description
|-----------------|--------|----------
| accessToken     | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| scope           | String | The scope of the object. Only the enterprise scope is supported.
| templateKey     | String | A unique identifier for the template. The identifier must be unique across the scope of the enterprise to which the metadata template is being applied to. Defaults to a string derived from the displayName if no value is provided.
| displayName     | String | The display name of the template.
| hidden          | Boolean| Whether this template is hidden in the UI. Defaults to false.
| fieldType       | String | The data type of the field's value. Templates support four attributes types: ```string```, ```enum```, ```float```, and ```date``` (RFC 3339).
| fieldKey        | String | A unique identifier for the field. The identifier must be unique within the template to which it belongs. Defaults to a string derived from the displayName if no value is provided.
| fieldDisplayName| String | The display name of the field

## Box.getEnterpriseTemplates
Used to retrieve all metadata templates within a user's enterprise. Only the enterprise scope is supported.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| marker     | String| The position marker at which to begin the response. See marker-based paging for details.
| limit      | String| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getFileAllMetadata
Used to retrieve all metadata associated with a given file

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File id

## Box.getFileSingleMetadata
Used to retrieve all metadata associated with a given file

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File id
| scope      | String| The scope of the metadata object (```global``` or ```enterprise_{enterprise_id}```)
| template   | String| The key of the template. For example, the ```global``` scope has the ```properties``` template.

## Box.createFileMetadata
Create a metadata instance for a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File id
| scope      | String| he scope of the metadata object (```global``` or ```enterprise_{enterprise_id}```)
| template   | String| The key of the template. For example, the ```global``` scope has the ```properties``` template.
| keyName    | String| Key name
| keyValue   | String| Value of key

## Box.deleteFileMetadata
Delete the template instance on a file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File id
| scope      | String| The scope of the metadata object (```global``` or ```enterprise_{enterprise_id}```)
| template   | String| The key of the template. For example, the ```global``` scope has the ```properties``` template.

## Box.getFolderAllMetadata
Used to retrieve all metadata associated with a given folder

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder id

## Box.getFolderSingleMetadata
Get the metadata instance for a folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder id
| scope      | String| The scope of the metadata object (```global``` or ```enterprise_{enterprise_id}```)
| template   | String| The key of the template. For example, the ```global``` scope has the ```properties``` template.

## Box.createFolderMetadata
Create a metadata instance for a folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder id
| scope      | String| he scope of the metadata object (```global``` or ```enterprise_{enterprise_id}```)
| template   | String| The key of the template. For example, the ```global``` scope has the ```properties``` template.
| keyName    | String| Key name
| keyValue   | String| Value of key

## Box.deleteFolderMetadata
Delete the metadata instance for a folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| File id
| scope      | String| The scope of the metadata object (```global``` or ```enterprise_{enterprise_id}```)
| template   | String| The key of the template. For example, the ```global``` scope has the ```properties``` template.

## Box.inviteUser
Invite an existing user to join an Enterprise.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields      | String| Comma-separated list of fields to include in the response
| enterpriseId| String| The ID of the enterprise the user will be invited to
| login       | String| The login of the user that will receive the invitation

## Box.getEnterpriseUsers
Returns all of the users for the Enterprise. Only available to admin accounts or service accounts.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userType   | String| The type of user to search for. One of all, external or managed. The default is managed
| filterTerm | String| Only return users whose name or login matches the ```filter_term```. See notes below for details on the matching.
| fields     | String| Comma-separated list of fields to include in the response
| offset     | String| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | String| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.deleteUser
Delete a user.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId     | String | The ID of the user
| notify     | Boolean| Whether the destination user will receive email notification of the transfer
| force      | Boolean| Whether the user should be deleted even if this user still own files

## Box.updateUser
Update the information for a user.

| Field             | Type   | Description
|-------------------|--------|----------
| accessToken       | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId            | String | The ID of the user
| fields            | String | Comma-separated list of fields to include in the response
| notify            | Boolean| Whether the destination user will receive email notification of the transfer
| enterprise        | String | Set this to null to roll the user out of the enterprise and make them a free user
| name              | String | The name of this user
| role              | String | The user’s enterprise role. Can be coadmin or user
| language          | String | The language of the user.
| isSyncEnabled     | Boolean| Whether the user can use Box Sync
| jobTitle          | String | The user’s job title
| phone             | String | The user’s phone number
| address           | String | The user’s address
| spaceAmount       | String | The user’s total available space amount in byte. A value of -1 grants unlimited storage.
| canSeeManagedUsers| String | Whether the user can see other enterprise users in its contact list
| status            | String | ```active```, ```inactive```, ```cannot_delete_edit```, or ```cannot_delete_edit_upload```

## Box.createAppUser
Create a new app user in an enterprise. This method only works for service accounts.

| Field               | Type   | Description
|---------------------|--------|----------
| accessToken         | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields              | String | Comma-separated list of fields to include in the response
| name                | String | The name of this user
| isPlatformAccessOnly| Boolean| The name of this user
| notify              | Boolean| Whether the destination user will receive email notification of the transfer
| enterprise          | String | Set this to null to roll the user out of the enterprise and make them a free user
| language            | String | The language of the user.
| jobTitle            | String | The user’s job title
| phone               | String | The user’s phone number
| address             | String | The user’s address
| spaceAmount         | String | The user’s total available space amount in byte. A value of -1 grants unlimited storage.
| status              | String | ```active```, ```inactive```, ```cannot_delete_edit```, or ```cannot_delete_edit_upload```

## Box.createUser
Create a new managed user in an enterprise. This method only works for enterprise admins.

| Field             | Type   | Description
|-------------------|--------|----------
| accessToken       | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields            | String | Comma-separated list of fields to include in the response
| login             | String | The email address the user uses to login
| name              | String | The name of this user
| role              | String | The user’s enterprise role. Can be coadmin or user
| language          | String | The language of the user.
| isSyncEnabled     | Boolean| Whether the user can use Box Sync
| jobTitle          | String | The user’s job title
| phone             | String | The user’s phone number
| address           | String | The user’s address
| spaceAmount       | String | The user’s total available space amount in byte. A value of -1 grants unlimited storage.
| canSeeManagedUsers| String | Whether the user can see other enterprise users in its contact list
| status            | String | ```active```, ```inactive```, ```cannot_delete_edit```, or ```cannot_delete_edit_upload```

## Box.getSingleUser
Get information about a user in the enterprise. Requires enterprise administration authorization.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields     | String| Comma-separated list of fields to include in the response
| userId     | String| The ID of the user

## Box.deleteEmailAlias
Removes an email alias from a user.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| emailAliasId| String| The ID of the email alias
| userId      | String| The ID of the user

## Box.createEmailAlias
Adds a new email alias to the given user’s account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| email      | String| The email address to add to the account as an alias
| userId     | String| The ID of the user

## Box.getMe
Get information about the user who is currently logged in (i.e. the user for whom this auth token was generated).

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields     | String| The email address to add to the account as an alias

## Box.getEmailAliases
Retrieves all email aliases for this user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId     | String| The ID of the user

## Box.changeUserLogin
Used to convert one of the user’s confirmed email aliases into the user’s primary login.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId     | String| The ID of the user
| fields     | String| The email address to add to the account as an alias
| login      | String| The email alias to become the primary email

## Box.moveOwnedItems
Move all of the items owned by a user into a new folder in another user’s account.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId     | String | The ID of the user
| folderId   | String | Must be 0 (the user's root folder)
| ownedById  | String | The ID of the user who the folder will be transferred to
| fields     | String | The email address to add to the account as an alias
| notify     | Boolean| Whether the destination user should receive email notification of the transfer

## Box.getGroup
Get information about a group.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupId    | String| Group ID
| fields     | String| The email address to add to the account as an alias

## Box.createGroup
Create a new group.

| Field                 | Type  | Description
|-----------------------|-------|----------
| accessToken           | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| name                  | String| The name of the new group to be created
| fields                | String| The email address to add to the account as an alias
| provenance            | String| Typically used to track the external source where the group is coming from. Retrieved through the fields parameter.
| externalSyncIdentifier| String| Typically used as a group identifier for groups coming from an external source. Retrieved through the fields parameter.
| description           | String| Description of the group. Retrieved through the fields parameter.

## Box.updateGroup
Update a group.

| Field                 | Type  | Description
|-----------------------|-------|----------
| accessToken           | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupId               | String| Group ID
| fields                | String| The email address to add to the account as an alias
| name                  | String| The name of the new group to be created
| provenance            | String| Typically used to track the external source where the group is coming from. Retrieved through the fields parameter.
| externalSyncIdentifier| String| Typically used as a group identifier for groups coming from an external source. Retrieved through the fields parameter.
| description           | String| Description of the group. Retrieved through the fields parameter.

## Box.deleteGroup
Delete a group.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupId    | String| Group ID

## Box.getEnterpriseGroups
Returns all of the groups for given enterprise. Must have permissions to see an enterprise's groups.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| name       | String| Only return groups whose name contains a word starting with the given string (case insensitive)
| fields     | String| The email address to add to the account as an alias
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getMembership
Fetches a specific group membership entry.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupMembershipId| String| Group membership id

## Box.createMembership
Add a member to a group.

| Field            | Type   | Description
|------------------|--------|----------
| accessToken      | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId           | String | The ID of the user to add to the group
| groupId          | String | The ID of the group to add the user into.
| role             | String | The role of the user in the group. Default is ```member``` option for ```admin```
| canRunReports    | Boolean| Can run reports
| canInstantLogin  | Boolean| Can instant login
| canCreateAccounts| Boolean| Can create accounts
| canEditAccounts  | Boolean| Can edit accounts

## Box.updateMembership
Fetches a specific group membership entry.

| Field            | Type   | Description
|------------------|--------|----------
| accessToken      | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupMembershipId| String | Membership Id
| role             | String | The role of the user in the group. Default is ```member``` option for ```admin```
| canRunReports    | Boolean| Can run reports
| canInstantLogin  | Boolean| Can instant login
| canCreateAccounts| Boolean| Can create accounts
| canEditAccounts  | Boolean| Can edit accounts

## Box.deleteMembership
Delete a group membership.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupMembershipId| String| Membership Id

## Box.getGroupMemberships
Returns all of the members for a given group if the requesting user has access.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupId    | String| Group id
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getUserMemberships
Returns all of the group memberships for a given user. Note this is only available to group admins. To retrieve group memberships for the user making the API request, use the users/me/memberships endpoint.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| userId     | String| User id
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getGroupCollaborations
Returns all of the group collaborations for a given group. Note this is only available to group admins.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| groupId    | String| Group id
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getCollaboration
Get information about a collaboration.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| collabId   | String| Collaboration Id
| fields     | String| The email address to add to the account as an alias

## Box.createCollaboration
Create a new collaboration that grants a user or group access to a file or folder in a specific role.

| Field            | Type   | Description
|------------------|--------|----------
| accessToken      | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields           | String | The email address to add to the account as an alias
| notify           | Boolean| Determines if the user (or all the users in the group) will receive email notifications
| itemType         | String | file or folder
| itemId           | String | The ID of the file or folder that access is granted to
| accessibleByType | String | user or group
| accessibleById   | String | The ID of the user or group that is granted access
| accessibleByLogin| String | The email address of the person to grant access to. Use instead of id to invite new users
| role             | String | The level of access granted. Can be ```editor```, ```viewer```, ```previewer```, ```uploader```, ```previewer uploader```, ```viewer uploader```, ```co-owner```, or ```owner```
| canViewPath      | Boolean| Whether view path collaboration feature is enabled or not. View path collaborations allow the invitee to see the entire ancestral path to the associated folder. The user will not gain privileges in any ancestral folder (e.g. see content the user is not collaborated on).

## Box.updateCollaboration
Update a collaboration.

| Field      | Type   | Description
|------------|--------|----------
| accessToken| String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| collabId   | String | Collaboration Id
| fields     | String | The email address to add to the account as an alias
| role       | String | The level of access granted. Can be ```editor```, ```viewer```, ```previewer```, ```uploader```, ```previewer uploader```, ```viewer uploader```, ```co-owner```, or ```owner```
| status     | String | The status of the collaboration invitation. Can be accepted, pending, or rejected.
| canViewPath| Boolean| Whether view path collaboration feature is enabled or not. View path collaborations allow the invitee to see the entire ancestral path to the associated folder. The user will not gain privileges in any ancestral folder (e.g. see content the user is not collaborated on).

## Box.deleteCollaboration
Delete a collaboration.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| collabId   | String| Collaboration Id

## Box.getPendingCollaborations
Get all pending collaboration invites for a user.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fields     | String| Comma-separated list of fields to include in the response
| offset     | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.getSingleComment
Get information about a comment.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| commentId  | String| Comment Id

## Box.createComment
Create a new comment.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| itemType     | String| The type of the item that this comment will be placed on. Can be file or comment
| itemId       | String| The ID of the item that this comment will be placed on
| message      | String| The text of the comment
| taggedMessage| String| The text of the comment, including ```@[userid:Username]``` somewhere in the message to mention the user, which will send them a direct email, letting them know they’ve been mentioned in a comment

## Box.updateComment
Update a comment.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| commentId  | String| The ID of the comment
| message    | String| The text of the comment

## Box.deleteComment
Delete a comment.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| commentId  | String| The ID of the comment

## Box.getWeblink
Get information about a web link.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| webLinkId  | String| The ID of the web link

## Box.createWebLink
Create a new web link.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| url        | String| The URL the web link points to. Must start with ```http://``` or ```https://```.
| parentId   | String| The ID of the parent folder where you're creating the web link
| name       | String| Name of the web link. Defaults to the URL if not set.
| description| String| Description of the web link

## Box.updateWebLink
Update a web link.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| webLinkId  | String| The ID of the web link
| url        | String| The UR the web link points to. Must start with ```http://``` or ```https://```.
| parentId   | String| The ID of the parent folder where you're creating the web link
| name       | String| Name of the web link. Defaults to the URL if not set.
| description| String| Description of the web link

## Box.deleteWebLink
Move a web link to the trash.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| webLinkId  | String| The ID of the web link

## Box.getUserEvents
Get events for a given user. A chunk of event objects is returned for the user based on the parameters passed in. Parameters indicating how many chunks are left as well as the next stream_position are also returned.

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| streamPosition| String| The location in the event stream from which you want to start receiving events. You can specify the special value now to get 0 events and the latest stream_position value. Specifying 0 will return all available events.
| limit         | Number| The maximum number of items to return. The default is 100 and the maximum is 500.

## Box.getEnterpriseEvents
Retrieves up to a year' events for all users in an enterprise. Upper and lower bounds as well as filters can be applied to the results.

| Field         | Type  | Description
|---------------|-------|----------
| accessToken   | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| eventType     | String| A comma-separated list of event types. Only matching events are returned.
| streamPosition| String| The location in the event stream from which you want to start receiving events. You can specify the special value now to get 0 events and the latest stream_position value. Specifying 0 will return all available events.
| limit         | Number| The maximum number of items to return. The default is 100 and the maximum is 500.

## Box.getWatermarkOnFile
Used to retrieve the watermark for a corresponding Box file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File ID

## Box.applyWatermarkOnFile
Used to apply or update the watermark for a corresponding Box file. The endpoint accepts a JSON body describing the watermark to apply.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File ID

## Box.removeWatermarkOnFile
Used to remove the watermark for a corresponding Box file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| File ID

## Box.getWatermarkOnFolder
Used to retrieve the watermark for a corresponding Box folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder ID

## Box.applyWatermarkOnFolder
Used to apply or update the watermark for a corresponding Box folder. The endpoints accepts a JSON body describing the watermark to apply.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder ID

## Box.removeWatermarkOnFolder
Used to remove the watermark for a corresponding Box folder.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| Folder ID

## Box.getDevicePin
Gets information about an individual device pin.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| devicePinId| String| Device pin ID

## Box.deleteDevicePin
Delete individual device pin

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| devicePinId| String| Device pin ID

## Box.getEnterpriseDevicePins
Gets all the device pins within a given enterprise. Must be an enterprise admin with the manage enterprise scope to make this call.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| enterpriseId| String| Enterprise ID
| limit       | String| The maximum number of items to return. The default is 100 and the maximum is 10,000.
| direction   | String| The sorting direction (by id). One of ```ASC``` or ```DESC``` (default is ASC). Case-insensitive.

## Box.getCollections
Retrieves the collections for the given user. Only the Favorites collection is supported.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.

## Box.getCollectionItems
Retrieves the files and/or folders contained within this collection. Collection item lists behave a lot like getting a folder’s items.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| collectionId| String| Collection Id.
| fields      | String| Comma-separated list of fields to include in the response
| offset      | Number| The offset of the item at which to begin the response. See offset-based paging for details.
| limit       | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.

## Box.addItemsToCollection
Add items from a Collection

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| collectionId| String| Collection Id.
| folderId    | String| FolderId

## Box.deleteItemsFromCollection
Remove items from a Collection

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| folderId   | String| FolderId

## Box.getTask
Fetches a specific task.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskId     | String| Task Id

## Box.createTask
Used to create a single task for single user on a single file.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId     | String| The ID of the file this task is associated with
| message    | String| An optional message to include with the task
| dueAt      | String| When this task is due. Example: ```2014-04-03T11:09:43-07:00```

## Box.updateTask
Updates a specific task.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskId     | String| Task Id
| message    | String| An optional message to include with the task
| dueAt      | String| When this task is due. Example: ```2014-04-03T11:09:43-07:00```

## Box.deleteTask
Permanently deletes a specific task.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskId     | String| Task Id

## Box.getTaskAssignment
Fetches a specific task assignment.

| Field           | Type  | Description
|-----------------|-------|----------
| accessToken     | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskAssignmentId| String| Task Assignment Id

## Box.createTaskAssignment
Used to assign a task to a single user. There can be multiple assignments on a given task.

| Field        | Type  | Description
|--------------|-------|----------
| accessToken  | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskId       | String| Task Id
| assignToId   | String| The ID of the user this assignment is for
| assignToLogin| String| The login email address for the user this assignment is for

## Box.updateTaskAssignment
Used to update a task assignment

| Field           | Type  | Description
|-----------------|-------|----------
| accessToken     | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskAssignmentId| String| Task Assignment Id
| message         | String| A message from the assignee about this task
| resolutionState | String| Can be ```completed```, ```incomplete```, ```approved```, or ```rejected```

## Box.deleteTaskAssignment
Deletes a specific task assignment.

| Field           | Type  | Description
|-----------------|-------|----------
| accessToken     | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskAssignmentId| String| Task Assignment Id

## Box.getTaskAssignments
Retrieves all of the assignments for a given task.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| taskId     | String| Task Id

## Box.getSingleRetentionPolicy
Used to retrieve information about a retention policy.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId   | String| Policy Id

## Box.createRetentionPolicy
Used to create a new retention policy. Only Business Plus or Enterprise account.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyName       | String| Name of retention policy to be created
| policyType       | String| ```finite``` or ```indefinite```
| retentionLength  | Number| The retention_length is the amount of time, in days, to apply the retention policy to the selected content in days. Do not specify for indefinite policies. Required for finite policies.
| dispositionAction| Number| If creating a finite policy, the disposition action can be ```permanently_delete``` or ```remove_retention```. For indefinite policies, disposition action must be ```remove_retention```.

## Box.updateRetentionPolicy
Used to update a retention policy. Only Business Plus or Enterprise account.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId         | String| Policy Id
| policyName       | String| Updated name of retention policy
| dispositionAction| Number| If creating a finite policy, the disposition action can be permanently_delete or remove_retention. For indefinite policies, disposition action must be remove_retention.
| status           | String| Used to retire a retention policy if status is set to retired. If not retiring a policy, do not include or set to null.

## Box.getRetentionPolicies
Retrieves all of the retention policies for the given enterprise. Only Business Plus or Enterprise account.

| Field          | Type  | Description
|----------------|-------|----------
| accessToken    | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyName     | String| A name to filter the retention policies by. A trailing partial match search is performed.
| policyType     | String| A policy type to filter the retention policies by.
| createdByUserId| String| A user ID to filter the retention policies by.

## Box.getRetentionPolicyAssignment
Used to retrieve information about a retention policy assignment. Only Business Plus or Enterprise account.

| Field                      | Type  | Description
|----------------------------|-------|----------
| accessToken                | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| retentionPolicyAssignmentId| String| Retention Policy Assignment Id

## Box.createRetentionPolicyAssignment
Used to retrieve information about a retention policy assignment. Only Business Plus or Enterprise account.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId    | String| The ID of the retention policy to assign this content to.
| assignToType| String| Can only be one of two attributes: enterprise or folder.
| assignToId  | String| Id of the content to assign the retention policy to

## Box.getSingleRetentionPolicyAssignments
Returns a list of all retention policy assignments associated with a specified retention policy. Only Business Plus or Enterprise account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId   | String| The ID of the retention policy to assign this content to.
| type       | String| The type of the retention policy assignment to retrieve. Can either be folder or enterprise.

## Box.getSingleFileVersionRetention
Used to retrieve information about a file version retention. Only Business Plus or Enterprise account.

| Field                 | Type  | Description
|-----------------------|-------|----------
| accessToken           | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileVersionRetentionId| String| File version retention Id

## Box.getFileVersionRetentions
Retrieves all file version retentions for the given enterprise. Only Business Plus or Enterprise account.

| Field            | Type  | Description
|------------------|-------|----------
| accessToken      | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| fileId           | String| A file ID to filter the file version retentions by
| fileVersionId    | String| A file version ID to filter the file version retentions by
| policyId         | String| A policy ID to filter the file version retentions by
| dispositionAction| String| The disposition action of the retention policy. This action can be permanently_delete, which will cause the content retained by the policy to be permanently deleted, or remove_retention, which will lift the retention policy from the content, allowing it to be deleted by users, once the retention policy time period has passed.
| dispositionBefore| String| See content times for formatting
| dispositionAfter | String| See content times for formatting
| limit            | Number| The maximum number of items to return. The default is 100.
| marker           | String| Base 64 encoded string that represents where the paging should being. It should be left blank to begin paging.

## Box.getSingleLegalHoldPolicy
Get information about a legal hold policy. Only Business Plus or Enterprise account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId   | String| Policy Id

## Box.createLegalHoldPolicy
Create a new legal hold policy. Only Business Plus or Enterprise account.

| Field          | Type   | Description
|----------------|--------|----------
| accessToken    | String | Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyName     | String | Name of Legal Hold Policy. Max characters 254.
| description    | String | Description of Legal Hold Policy. Max characters 500.
| filterStartedAt| String | Date filter applies to Custodian assignments only.
| filterEndedAt  | String | Date filter applies to Custodian assignments only.
| isOngoing      | Boolean| After initialization, Assignments under this Policy will continue applying to files based on events, indefinitely.

## Box.updateLegalHoldPolicy
Update a legal hold policy. Only Business Plus or Enterprise account.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId    | String| Policy Id
| policyName  | String| Name of Legal Hold Policy. Max characters 254.
| description | String| Description of Legal Hold Policy. Max characters 500.
| releaseNotes| String| Notes around why the policy was released. Optional property with a 500 character limit.

## Box.deleteLegalHoldPolicy
Sends a request to delete an existing legal hold policy. Note that this is an asynchronous process - the policy will not be fully deleted yet when the response comes back. Only Business Plus or Enterprise account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId   | String| Policy Id

## Box.getLegalHoldPolicies
Get all of the legal hold policies for the enterprise. Only Business Plus or Enterprise account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyName | String| Case insensitive prefix-match filter on Policy name.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 1,000.
| marker     | String| Take from 'next_marker' column of a prior call to get the next page

## Box.getSinglePolicyAssignment
Get information about a policy assignment. Only Business Plus or Enterprise account.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| assignmentId| String| Assignment Id

## Box.createNewPolicyAssignment
Create a new policy assignment, which applies the legal hold policy to the target of the assignment. Only Business Plus or Enterprise account.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId    | String| ID of Policy to create Assignment for.
| assignToId  | String| Possible values for id are file_version_id, file_id, folder_id, or user_id
| assignToType| String| Possible values for type are ```file_version```, ```file```, ```folder```, or ```user```

## Box.deletePolicyAssignment
Sends a request to delete an existing policy assignment. Note that this is an asynchronous process - the policy assignment will not be fully deleted yet when the response comes back. Only Business Plus or Enterprise account.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| assignmentId| String| Assignment Id

## Box.getPolicyAssignments
Get all of the assignments for a legal hold policy. Only Business Plus or Enterprise account.

| Field       | Type  | Description
|-------------|-------|----------
| accessToken | String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId    | String| ID of Policy to get Assignments for. Can also specify a part of a URL
| assignToType| String| Filter assignments of this type only. Can be ```file_version```, ```file```, ```folder```, or ```user```.
| assignToId  | String| Filter assignments to this ID only. Note that this will only show assignments applied directly to this entity.

## Box.getFileVersionSingleLegalHold
Get information about a file version legal hold. Only Business Plus or Enterprise account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| id         | String| ID of File Version Legal Hold

## Box.getFileVersionLegalHolds
Get all of the non-deleted legal holds for a single legal hold policy. Only Business Plus or Enterprise account.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| policyId   | String| Policy Id

## Box.getWebhooks
Get all webhooks in an enterprise.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| marker     | String| The position marker at which to begin the response. See marker-based paging for details.
| limit      | Number| The maximum number of items to return. The default is 100 and the maximum is 200.

## Box.getSingleWebhook
Get information about a webhook.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| webhookId  | String| Webhook Id

## Box.createWebhook
Create a new webhook.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| targetType | String| Target type. file or folder
| targetId   | String| Target Id
| triggers   | String| Event types that trigger notifications for the target. Example: ```FILE.UPLOADED```,```FILE.DOWNLOADED```
| address    | String| The notification URL of the webhook. The notification URL is the URL used by Box to send a notification when the webhook is triggered.

## Box.updateWebhook
Update a webhook.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| webhookId  | String| Webhook Id
| targetType | String| Target type
| targetId   | String| Target Id
| triggers   | String| Event types that trigger notifications for the target. Example:```FILE.UPLOADED```,```FILE.DOWNLOADED```
| address    | String| The notification URL of the webhook. The notification URL is the URL used by Box to send a notification when the webhook is triggered.

## Box.deleteWebhook
Delete a webhook.

| Field      | Type  | Description
|------------|-------|----------
| accessToken| String| Access token is a data string that enables Box to verify that a request belongs to an authorized session.
| webhookId  | String| Webhook Id

