<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streaming extends Auth_Controller
{

    public function index($id)
    {
        switch($id) {
            case 1:
                $ip = 'http://wms.shared.streamshow.it/carinatv/carinatv/playlist.m3u8';
                break;
            case 2:
                $ip = 'http://wms.shared.streamshow.it/carinatv/carinatv/playlist.m3u8';
                break;
            default:
                $ip = 'http://wms.shared.streamshow.it/carinatv/carinatv/playlist.m3u8';
                break;
        }

        $this->data['source'] = $ip;
        $this->render('streaming/index_view', null);
//        $this->render('streaming/fp/index_view', null);
    }
}