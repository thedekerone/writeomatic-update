<?php

namespace App\Http\Controllers;
use \stdClass;
use App\Models\OpenAIGenerator;
use GuzzleHttp\Client;
use App\Models\Setting;
use App\Models\SettingTwo;
use App\Models\UserOpenai;
use App\Models\UserOpenaiChat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use OpenAI;
use OpenAI\Laravel\Facades\OpenAI as FacadesOpenAI;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
class AllInOneBlogWriterController extends Controller {

   public function openAIGeneratorWorkbookAllInOne($slug)
   {

   }

   public function allInOneBlogWriterList() {
      $slug = 'article_generator';
      
      $openai = OpenAIGenerator::whereSlug($slug)->firstOrFail();
      $settings = Setting::first();
      // Fetch the Site Settings object with openai_api_secret
      $apiKeys = explode(',', $settings->openai_api_secret);
      $apiKey = $apiKeys[array_rand($apiKeys)];

      $len = strlen($apiKey);
      $parts[] = substr($apiKey, 0, $l[] = rand(1, $len - 5));
      $parts[] = substr($apiKey, $l[0], $l[] = rand(1, $len - $l[0] - 3));
      $parts[] = substr($apiKey, array_sum($l));
      $apikeyPart1 = base64_encode($parts[0]);
      $apikeyPart2 = base64_encode($parts[1]);
      $apikeyPart3 = base64_encode($parts[2]);
      $apiUrl = base64_encode('https://api.openai.com/v1/chat/completions');
      return view('panel.user.openai.all_in_one_blog', compact(
          'openai',
          'apikeyPart1',
          'apikeyPart2',
          'apikeyPart3',
          'apiUrl',
      ));
      return view('panel.user.openai.all_in_one_blog'); //
   }


}
