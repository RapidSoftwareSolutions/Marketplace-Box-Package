<?php

$app->post('/api/Box/getFileVersionRetentions', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    $accessToken = $post_data['args']['accessToken'];

    $query = [];
    if(!empty($post_data['args']['fileId'])){
        $query['file_id'] = $post_data['args']['fileId'];
    }
    if(!empty($post_data['args']['fileVersionId'])){
        $query['file_version_id'] = $post_data['args']['fileVersionId'];
    }
    if(!empty($post_data['args']['policyId'])){
        $query['policy_id'] = $post_data['args']['policyId'];
    }
    if(!empty($post_data['args']['dispositionAction'])){
        $query['disposition_action'] = $post_data['args']['dispositionAction'];
    }
    if(!empty($post_data['args']['dispositionBefore'])){
        $query['disposition_before'] = $post_data['args']['dispositionBefore'];
    }
    if(!empty($post_data['args']['dispositionAfter'])){
        $query['disposition_after'] = $post_data['args']['dispositionAfter'];
    }
    if(!empty($post_data['args']['limit'])){
        $query['limit'] = $post_data['args']['limit'];
    }
    if(!empty($post_data['args']['marker'])){
        $query['marker'] = $post_data['args']['marker'];
    }

    $query_str = $settings['default_url'] . "file_version_retentions";
    $client = $this->httpClient;

    try {
        $resp = $client->get($query_str, [
            'headers' => [
                'Authorization' => 'Bearer ' .$accessToken,
            ],
            'query' => $query
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
