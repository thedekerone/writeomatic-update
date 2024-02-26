<?php

namespace App\Http\Controllers;

use App\Jobs\SendConfirmationEmail;
use App\Models\Blog;
use App\Models\Clients;
use App\Models\CustomSettings;
use App\Models\Faq;
use App\Models\FrontendForWho;
use App\Models\FrontendFuture;
use App\Models\FrontendGenerators;
use App\Models\FrontendTools;
use App\Models\Hero;
use App\Models\HowitWorks;
use App\Models\OpenAIGenerator;
use App\Models\OpenaiGeneratorFilter;
use App\Models\PaymentPlans;
use App\Models\Setting;
use App\Models\FrontendSectionsStatusses;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;



class KanbanController extends Controller
{
    public function index() {
        return view('panel.user.kanban.index'); 
    }
}
