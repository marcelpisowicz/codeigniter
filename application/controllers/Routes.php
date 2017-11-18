<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Routes extends Auth_Controller
{

    public function index()
    {
        $routes = Route::all();
        $this->data['routes'] = $routes;
        $this->table->set_heading(['name', 'description']);
//        $this->table->add_action('/home/gps', '/assets/icons/gps.png');
//        $this->table->add_action('/home/location', '/assets/icons/location.png');
//        $this->table->add_action('/streaming/index', '/assets/icons/fullscreen.png', 'Streaming', [900, 450]);
//        $this->table->add_action('/home/details', '/assets/icons/document.png', 'Details');
//        $this->table->add_action('/home/analyze', '/assets/icons/analyze.png');
        $this->table->add_action_delete();
        $this->table->add_click();

        $this->add_menu_new();
        $this->add_menu('#', '/assets/icons/settings.png', 'Settings');

        $this->data['table'] = $this->table->generate($routes);

        $this->render('routes/index_view');
    }

    public function details($id = null)
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
        } else {
            $this->data['center_lat'] = 51.110;
            $this->data['center_lng'] = 17.055;
        }

        $this->add_menu_return();
        $this->add_menu_save();
        $this->add_menu_delete($id);

        $this->render('routes/details_view');
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

        $this->redirect($route_id);
    }

    public function delete($id)
    {
        Route::destroy($id);
        $this->redirect();
    }
}
