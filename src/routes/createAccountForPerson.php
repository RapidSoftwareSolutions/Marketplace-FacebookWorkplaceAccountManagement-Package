<?php

$app->post('/api/FacebookWorkplaceAccountManagement/createAccountForPerson', function ($request, $response) {

    $settings = $this->settings;
    $checkRequest = $this->validation;

    $validateRes = $checkRequest->validate($request, ['accessToken', 'scimId', 'userName', 'name']);

    if(!empty($validateRes) && isset($validateRes['callback']) && $validateRes['callback']=='error') {
        return $response->withHeader('Content-type', 'application/json')->withStatus(200)->withJson($validateRes);
    } else {
        $post_data = $validateRes;
    }

    $accessToken = $post_data['args']['accessToken'];
    $scimId = $post_data['args']['scimId'];
    $username = $post_data['args']['userName'];
    $name = $post_data['args']['name'];
    $email = false;
    $title = false;
    $nickName = false;


    if(!empty($post_data['args']['email']))
    {
        $email = $post_data['args']['email'];
    }

    if(!empty($post_data['args']['title']))
    {
        $title = $post_data['args']['title'];
    }

    if(!empty($post_data['args']['nickName']))
    {
        $nickName = $post_data['args']['nickName'];
    }

    $active = true;
    if(isset($post_data['args']['active']))
    {
        if($post_data['args']['active'] == "true"){
            $active = true;
        } else if($post_data['args']['active'] == "false"){
            $active = false;
        }

    }


    $scim = new \Models\ScimModel($username, $name, $active, $email, $title, $nickName);
    $data = $scim->genSchema();

    $query_str = $settings['api_url'] . "$scimId/scim/Users";
    $client = $this->httpClient;

    try {

        $resp = $client->post($query_str, [
            'headers' => [
                'Authorization' => "Bearer ".$accessToken,
                'Content-Type' => "application/json"
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
