<?php

$app->post('/api/Box/updateFolder', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','folderId']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $accessToken = $post_data['args']['accessToken'];
    $folderId = $post_data['args']['folderId'];
    $query = [];
    $data= [];
    $optionalParam = ['name'=>'name','description'=>'description','sync_state'=>'sync_state','tags'=>'tags'];

    if(!empty($post_data['args']['fields']))
    {
        $query['fields'] = implode(",",$post_data['args']['fields']);
    }

    if(isset($post_data['args']['parentId']))
    {
        $data['parent'] = ["id"=>$post_data['args']['parentId']];
    }

    if(!empty($post_data['args']['sharedLinkAccess']))
    {
        $data['shared_link'] = ["access"=>$post_data['args']['sharedLinkAccess']];
    }
    if(!empty($post_data['args']['sharedLinkPassword']))
    {
        $data['shared_link'] = ["password"=>$post_data['args']['sharedLinkPassword']];
    }
    if(!empty($post_data['args']['sharedLinkUnsharedAt']))
    {
        $data['shared_link'] = ["unshared_at"=>$post_data['args']['sharedLinkUnsharedAt']];
    }
    if(isset($post_data['args']['sharedLinkPermissionsCanDownload']))
    {
        if($post_data['args']['sharedLinkPermissionsCanDownload'] == "true"){
            $data['shared_link']["permissions"]["can_download"] = true;
        } else {
            $data['shared_link']["permissions"]["can_download"] = false;
        }
    }

    if(!empty($post_data['args']['ownedById']))
    {
        $data['owned_by'] = ["id"=>$post_data['args']['ownedById']];
    }

    foreach ($post_data['args'] as $key=>$value)
    {
        if(array_key_exists($key, $optionalParam) && !empty($value))
        {
            $data[$optionalParam[$key]] = $value;
        }
    }

    $query_str = $settings['folder_url'] . $folderId;
    $client = $this->httpClient;

    try {

        $resp = $client->put($query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' .$accessToken,
            ],
            'query'=>$query,
            'json' => $data
        ]);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        } else {
            $result['callback'] = 'error';
            $result['contextWrites']['to']['status_code'] = 'API_ERROR';
            $result['contextWrites']['to']['status_msg'] = json_decode($responseBody);
        }

    } catch (\GuzzleHttp\Exception\ClientException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ServerException $exception) {

        $responseBody = $exception->getResponse()->getBody()->getContents();
        if(empty(json_decode($responseBody))) {
            $out = $responseBody;
        } else {
            $out = json_decode($responseBody);
        }
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'API_ERROR';
        $result['contextWrites']['to']['status_msg'] = $out;

    } catch (GuzzleHttp\Exception\ConnectException $exception) {

        $responseBody = $exception->getResponse()->getBody(true);
        $result['callback'] = 'error';
        $result['contextWrites']['to']['status_code'] = 'INTERNAL_PACKAGE_ERROR';
        $result['contextWrites']['to']['status_msg'] = 'Something went wrong inside the package.';

    }

    return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($result);

});
