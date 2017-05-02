<?php

$app->post('/api/Box/createCollaboration', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','itemType','itemId','role','accessibleByType','accessibleById']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    $accessToken = $post_data['args']['accessToken'];

    $data['item']['id'] = $post_data['args']['itemId'];
    $data['item']['type'] = $post_data['args']['itemType'];
    $data['role'] = $post_data['args']['role'];
    $data['accessible_by']['type'] = $post_data['args']['accessibleByType'];
    $data['accessible_by']['id'] = $post_data['args']['accessibleById'];

    $fields = [];
    if(!empty($post_data['args']['fields'])){
        $fields['fields'] = $post_data['args']['fields'];
    }
    if(isset($post_data['args']['notify'])){
        $fields['notify'] = $post_data['args']['notify'];
    }
    if(!empty($post_data['args']['accessibleByLogin'])){
        $data['accessible_by']['login'] = $post_data['args']['accessibleByLogin'];
    }
    if(!empty($post_data['args']['canViewPath'])){
        $data['can_view_path'] = $post_data['args']['canViewPath'];
    }

    $query_str = $settings['default_url'] . "collaborations/";
    $client = $this->httpClient;

    try {
        $resp = $client->post($query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' .$accessToken,
            ],
            'query' => $fields,
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
