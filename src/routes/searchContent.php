<?php

$app->post('/api/Box/searchContent', function ($request, $response) {
    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken', 'query']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    $accessToken = $post_data['args']['accessToken'];

    $data= [];
    $data['query'] = $post_data['args']['query'];
    $optionalParam = ['scope'=>'scope','fileExtensions'=>'file_extensions','createdAtRange'=>'created_at_range','updatedAtRange'=>'updated_at_range','sizeRange'=>'size_range','ownerUserIds'=>'owner_user_ids','ancestorFolderIds'=>'ancestor_folder_ids','contentTypes'=>'content_types','type'=>'type','trashContent'=>'trash_content','fields'=>'fields','offset'=>'offset','limit'=>'limit'];

    foreach ($post_data['args'] as $key=>$value)
    {
        if(array_key_exists($key, $optionalParam) && !empty($value))
        {
            $data[$optionalParam[$key]] = $value;
        }
    }

    if(!empty($data['fields']))
    {
        $data['fields'] = implode(",",$data['fields']);
    }

    if(!empty($data['file_extensions']))
    {
        $data['file_extensions'] = implode(",",$data['file_extensions']);
    }

    if(!empty($data['content_types']))
    {
        $data['content_types'] = implode(",",$data['content_types']);
    }

    if(!empty($data['ancestor_folder_ids']))
    {
        $data['ancestor_folder_ids'] = implode(",",$data['ancestor_folder_ids']);
    }

    if(!empty($data['owner_user_ids']))
    {
        $data['owner_user_ids'] = implode(",",$data['owner_user_ids']);
    }


    $query_str = $settings['default_url'] . "search";
    $client = $this->httpClient;
    try {

        $resp = $client->get($query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' .$accessToken
            ],
            'query' => $data,
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
