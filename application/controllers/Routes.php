<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends Auth_Controller
{

    public function index()
    {

    }

    public function create($id = null)
    {
        $route = Route::find($id);
        $creator = User::find($route['creator_user_id']);

        $this->data['id'] = $id;
        $this->data['route'] = $route;
        $this->data['creator'] = $creator;

        $route_points = Route_Point::where('route_id', '=', $id)->get();
        $points = [];

        foreach ($route_points as $route_point) {
            $points[] = ['lat' => $route_point->latitude, 'lng' => $route_point->longitude];
        }

        if(!empty($points)) {

            $min_lat = min(array_column($points, 'lat'));
            $max_lat = max(array_column($points, 'lat'));
            $min_lng = min(array_column($points, 'lng'));
            $max_lng = max(array_column($points, 'lng'));

            $this->data['center_lat'] = $min_lat + (($max_lat - $min_lat) / 2);
            $this->data['center_lng'] = $min_lng + (($max_lng - $min_lng) / 2);

            $this->data['route_points'] = json_encode($points, JSON_NUMERIC_CHECK);
        }

        $this->add_menu('/', '/assets/icons/return.png', 'Return');
        $this->add_save();
        $this->add_delete();

        $this->render('routes/create_view');
    }

    public function save()
    {
        $post = $this->input->post();

        $route_id = (int)$post['id'];
        $user_id = $this->session->get_userdata()['user_id'];

        $route = Route::findOrNew($route_id);
        $route->name = (string)$post['name'];
        $route->creator_user_id = $user_id;
        $route->description = $post['description'];
        $route->active = (int)isset($post['active']);
        $route->save();

        $route_id = $route->getKey();
        $points = json_decode($post['route'], true);

        if(!empty($points)) {

            Route_Point::where('route_id', $route_id)->delete();

            foreach ($points as $key => $point) {
                $values = [
                    'route_id' => $route_id,
                    'order' => $key,
                    'latitude' => $point['lat'],
                    'longitude' => $point['lng']
                ];

                Route_Point::create($values);
            }
        }

        redirect('routes/create/'.$route_id);
    }
}
