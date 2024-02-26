<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $path = resource_path('/dev_tools/currency.sql');
        DB::unprepared(file_get_contents($path));

        $path2 = resource_path('/dev_tools/openai_table.sql');
        DB::unprepared(file_get_contents($path2));

        $path3 = resource_path('/dev_tools/openai_chat_categories_table.sql');
        DB::unprepared(file_get_contents($path3));

        $path4 = resource_path('/dev_tools/openai_filters.sql');
        DB::unprepared(file_get_contents($path4));

        $path5 = resource_path('/dev_tools/frontend_tools.sql');
        DB::unprepared(file_get_contents($path5));

        $path6 = resource_path('/dev_tools/faq.sql');
        DB::unprepared(file_get_contents($path6));

        $path7 = resource_path('/dev_tools/frontend_future.sql');
        DB::unprepared(file_get_contents($path7));

        $path8 = resource_path('/dev_tools/howitworks.sql');
        DB::unprepared(file_get_contents($path8));

        $path9 = resource_path('/dev_tools/testimonials.sql');
        DB::unprepared(file_get_contents($path9));

        $path10 = resource_path('/dev_tools/frontend_who_is_for.sql');
        DB::unprepared(file_get_contents($path10));

        $path11 = resource_path('/dev_tools/frontend_generators.sql');
        DB::unprepared(file_get_contents($path11));

        $path12 = resource_path('/dev_tools/clients.sql');
        DB::unprepared(file_get_contents($path12));

        $path13 = resource_path('/dev_tools/health_check_result_history_items.sql');
        DB::unprepared(file_get_contents($path13));

        $path14 = resource_path('/dev_tools/email_templates.sql');
        DB::unprepared(file_get_contents($path14));

        $path15 = resource_path('/dev_tools/ads.sql');
        DB::unprepared(file_get_contents($path15));

        $path16 = resource_path('/dev_tools/ai_wizard.sql');
        DB::unprepared(file_get_contents($path16));

        $path17 = resource_path('/dev_tools/ai_vision.sql');
        DB::unprepared(file_get_contents($path17));

        $path18 = resource_path('/dev_tools/ai_vision2.sql');
        DB::unprepared(file_get_contents($path18));

        $path19 = resource_path('/dev_tools/ai_pdf.sql');
        DB::unprepared(file_get_contents($path19));

        $path20 = resource_path('/dev_tools/ai_pdf2.sql');
        DB::unprepared(file_get_contents($path20));

        $path21 = resource_path('/dev_tools/ai_chat_image.sql');
        DB::unprepared(file_get_contents($path21));

        $path22 = resource_path('/dev_tools/ai_chat_image2.sql');
        DB::unprepared(file_get_contents($path22));

        $path23 = resource_path('/dev_tools/ai_rewriter.sql');
        DB::unprepared(file_get_contents($path23));

        $path24 = resource_path('/dev_tools/team_email_templates.sql');
        DB::unprepared(file_get_contents($path24));

        $path25 = resource_path('/dev_tools/ai_webchat.sql');
        DB::unprepared(file_get_contents($path25));

        $path26 = resource_path('/dev_tools/ai_webchat2.sql');
        DB::unprepared(file_get_contents($path26));

        $path27 = resource_path('/dev_tools/ai_filechat.sql');
        DB::unprepared(file_get_contents($path27));

        $path28 = resource_path('/dev_tools/ai_filechat2.sql');
        DB::unprepared(file_get_contents($path28));

        $this->command->info('Currency table seeded!');
    }
}
