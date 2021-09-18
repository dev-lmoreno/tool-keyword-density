<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Html2Text\Html2Text;

class ToolController extends Controller
{
    public function index()
    {
        return view('tool.index');
    }

    public function CalculateAndGetDensity(Request $request) 
    {
        if ($request->isMethod('POST')) {

            if (isset($request->keywordInput)) {
                $html = new Html2Text($request->keywordInput);
                $text = strtolower($html->getText());
                $totalWordCount = str_word_count($text);
                $wordsAndOccurrence  = array_count_values(str_word_count($text, 1));
                arsort($wordsAndOccurrence);

                $keywordDensityArray = [];

                foreach ($wordsAndOccurrence as $key => $value) {
                    $keywordDensityArray[] = ["keyword" => $key,
                        "count" => $value,
                        "density" => round(($value / $totalWordCount) * 100,2)];
                }

                return $keywordDensityArray;
            }
        }
    }
}
