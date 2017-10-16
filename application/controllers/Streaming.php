<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Streaming extends Auth_Controller
{

    public function index($id)
    {
        switch($id) {
            case 1:
                $ip = 'https://nasa-i.akamaihd.net/hls/live/253565/NASA-NTV1-Public/master.m3u8';
                break;
            case 2:
                $ip = 'https://stream.novascotiawebcams.com/live-origin/whitepointbeach/playlist.m3u8?DVR';
                break;
            case 3:
                $ip = 'http://qthttp.apple.com.edgesuite.net/1010qwoeiuryfg/sl.m3u8';
                break;
            case 4:
                $ip = 'http://content.jwplatform.com/manifests/vM7nH0Kl.m3u8';
                break;
            default:
                $ip = 'http://wms.shared.streamshow.it/carinatv/carinatv/playlist.m3u8';
                break;
        }

        $this->data['source'] = $ip;
        $this->render('streaming/index_view', null);
    }
}