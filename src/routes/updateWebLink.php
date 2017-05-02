<?php

$app->post('/api/Box/updateWebLink', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','webLinkId']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    $accessToken = $post_data['args']['accessToken'];
    $webLinkId = $post_data['args']['webLinkId'];
    $fields = [];
    if(!empty($post_data['args']['fields'])){
        $fields['fields'] = $post_data['args']['fields'];
    }

    $data = [];
    $optionalParam = ['name'=>'name' ,'description'=>'description','url'=>'url'];
    foreach ($post_data['args'] as $key=>$value)
    {
        if(array_key_exists($key, $optionalParam) && !empty($value))
        {
            $data[$optionalParam[$key]] = $value;
        }
    }
    if(!empty($post_data['args']['parentId']))
    {
        $data['parent']["id"] = $post_data['args']['parentId'];
    }

    $query_str = $settings['default_url'] . "web_links/$webLinkId";
    $client = $this->httpClient;
    try {

        $resp = $client->put($query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' .$accessToken,
            ],
            'json' => $data
        ]);
        $responseBody = $resp->getBody()->getContents();

        if(in_array($resp->getStatusCode(), ['200', '201', '202', '203', '204'])) {
            $result['callback'] = 'success';
            $result['contextWrites']['to'] = is_array($responseBody) ? $responseBody : json_decode($responseBody);
            if(empty($result['contextWrites']['to'])) {
                $result['contextWrites']['to']['status_msg'] = "Api return no results";
            }
        }
        else {
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
