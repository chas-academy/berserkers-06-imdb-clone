<?php

namespace App\Traits;

use App\Character;
use App\Episode;
use App\Person;
use App\Season;
use App\Series;
use App\Movie;
use App\Title;
use App\Genre;
use App\Photo;

trait DatabaseHelpers 
{

  protected function formatForEditing($items) {
    
    $collection = "";

    foreach($items as $key => $item) {

      if (isset($items[0]->photo_path)) {
  
          $collection .= 'photo_path: ' . $item->photo_path . ' | photo_type: ' . $item->photo_type . ' | width: ' . $item->width . ' | ratio: ' . $item->ratio;
          
          if(isset($items[$key +1] )) {

              $collection .= "\n";
          }

        } elseif (isset($items[0]->actor)) {

          foreach($item->actor as $key => $actor) {
              
            if($key === 0) {
              $collection .= $actor->name . ' As ' . $item->character_name;

              if(isset($items[$key +1] )) {
                  
                $collection .=  "\n";
              }
            }
          }

        } else {

            $collection .= $item->name;

            if(isset($items[$key +1] )) {
                
                $collection .= "\n";
            } 
        }
    }

    return $collection;
  }

  protected function updateItem($request, $item) {
    
    $id = $item->title_id;
    $title = Title::find($id);

    foreach(self::PIVOTTABLES as $pivot) {
      if ($request->has($pivot)) {
        if ($request->has('actorsAsCharacters')) {
          $names = preg_split("/(\r\n| As )/",$request->get($pivot));
          $personsIds = [];
          $charactersIds = [];
          for ($i = 0; $i < count($names); $i++) {
            if ( ($i % 2) === 0) {
              $table = Person::firstOrCreate(['name' => $names[$i]]);
              array_push($personsIds, $table->id);
            } else {
              $table = Character::firstOrCreate(['character_name' => $names[$i]]);
              array_push($charactersIds, ['character_id' => $table->id]);
            }
          }

          $actorsAsCharactersIds = array_combine($personsIds, $charactersIds);
          
          $title->actors()->sync($actorsAsCharactersIds);

          return; 

        } elseif($request->has('photos')) {

          $photos = explode("\r\n",$request->get($pivot));

          foreach($photos as $key => $photo) {

            $keyvalues = (explode(' | ', $photo));
            $photovalues = [];

            foreach ($keyvalues as $newkey => $keyvalue) {

              $keyvalues[$newkey] = explode(': ', $keyvalue);
              $photovalues[$keyvalues[$newkey][0]] = $keyvalues[$newkey][1];
            }
            $photos[$key] = $photovalues;
    
          }

          $photosIds = [];

        foreach($photos as $photo) {

          $item = $title->photos()->where('photo_path', $photo['photo_path'])->get(['*']);
          
          if (!isset($item[0])) {

            $item = Photo::create([

              'imageable_id' => $title->id,
              'imageable_type' => get_class($title),
              'photo_path' => $photo['photo_path'], 
              'photo_type' => $photo['photo_type'],
              'width' => $photo['width'],
              'ratio' => $photo['ratio']
              ]);

              array_push($photosIds, $item->id);

          } else {

            array_push($photosIds, $item[0]->id);
          }
        }
        $tobeRemoved = $title->photos()->whereNotIn('id', $photosIds);
        
        foreach($tobeRemoved->get(['id']) as $photo) {

          Photo::where('id', '=', $photo->id)->delete();
        }
        
        return; 

        } else {

          $names = explode("\r\n",$request->get($pivot));
          $pivotIds = [];

          foreach ($names as $name) {
            if(strlen($name) != 0) {
              
              if ($pivot === 'genres') {
                
                  $table = Genre::firstOrCreate(['name' => $name]);
                  array_push($pivotIds, $table->id);
    
                } else {
    
                  $table = Person::firstOrCreate(['name' => $name]);
                  
                  array_push($pivotIds, $table->id);
                }
              }
            }
          $title->$pivot()->sync($pivotIds);

          return; 
        }
      }
    }
    
    foreach(self::ITEMCOLUMNS as $column) {

      if ($request->has($column)) {

          $item->$column = $request->get($column);
          $item->save();
          
          return;         
      } 
    }
  }    

  protected function getRedirectPath($id, $subId = null, $subsubId = null){

    $path = "/titles/" . self::TYPENAME . "/$id";

    if (isset($subId)) {
      $path .= "/" . self::SUBTYPE . "/" . $subId;
    } 
    
    if (isset($subsubId)) {
      $path .= "/" . self::SUBSUBTYPE . "/" . $subsubId;
    }
    return $path;
  }


  protected function detachAllFromItemAndDelete($item, $type, $id) {
    
    try {

        $item->directors()->detach();
        $item->producers()->detach();
        $item->screenwriters()->detach();
        $item->creators()->detach();
        $item->genres()->detach();
        $item->actors()->detach();
        $item->ratings()->detach();
        $type::where('title_id', '=', $id)->delete();
        Photo::where('imageable_id' ,'=' , $id)->delete();
        Title::where('id', '=', $id)->delete();

    } catch (Exceptions $e) {

        return $e;
    }

    return;
  }

  protected function updateNumOfEpisodesAndSeasonsColumns($series)
  {
    $allSeasons = Season::where('series_id', '=', $series->title_id)->get();
    $allSeasonsIds = [];
    
    foreach($allSeasons as $season) {
        array_push($allSeasonsIds, $season->title_id);
    }
    
    $allEpisodes = Episode::whereIn('season_id', $allSeasonsIds)->get()->count();
    
    $series->update(['num_of_seasons' => $allSeasons->count(),'num_of_episodes' => $allEpisodes]);
  }
}