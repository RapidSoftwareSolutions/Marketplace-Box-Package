<?php

$app->post('/api/Box/createMembership', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;
    $validateRes = $checkRequest->validate($request, ['accessToken','userId','groupId']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }
    $accessToken = $post_data['args']['accessToken'];
    $data["user"]["id"] = $post_data['args']['userId'];
    $data["group"]["id"] = $post_data['args']['groupId'];

    if(!empty($post_data['args']['role'])){
        $data['role'] = $post_data['args']['role'];
    }
    if(isset($post_data['args']['canRunReports'])){
        $data['configurable_permissions']['can_run_reports'] = $post_data['args']['canRunReports'];
    }
    if(isset($post_data['args']['canInstantLogin'])){
        $data['configurable_permissions']['can_instant_login'] = $post_data['args']['canInstantLogin'];
    }
    if(isset($post_data['args']['canCreateAccounts'])){
        $data['configurable_permissions']['can_create_accounts'] = $post_data['args']['canCreateAccounts'];
    }
    if(isset($post_data['args']['canEditAccounts'])){
        $data['configurable_permissions']['can_edit_accounts'] = $post_data['args']['canEditAccounts'];
    }

    $query_str = $settings['default_url'] . "group_memberships";
    $client = $this->httpClient;

    try {

        $resp = $client->post($query_str, [
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
