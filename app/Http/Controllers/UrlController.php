<?php

namespace App\Http\Controllers;

use App\Models\Url;
use App\Http\Requests\StoreUrlRequest;
use App\Http\Requests\UpdateUrlRequest;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Ariaieboy\LaravelSafeBrowsing\LaravelSafeBrowsing;
use Illuminate\Support\Facades\Redirect;

class UrlController extends Controller
{
    protected $safeBrowsing;

    public function __construct()
    {
        $this->safeBrowsing = new LaravelSafeBrowsing();
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inertia::render('Index', [
            'urls' => Url::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUrlRequest $request)
    {
        $redirectResponseSafeUrl = $this->checkSafeUrl($request->url);
        if ($redirectResponseSafeUrl) {
            return $redirectResponseSafeUrl;
        }

        $redirectResponseUrlExists = $this->checkIfUrlExists($request->url);
        if ($redirectResponseUrlExists) {
            return $redirectResponseUrlExists;
        }

        $data = $request->validated();

        $shortenedUrl = $this->generateUniqueShortUrl();
        $data['shortened_url'] = $shortenedUrl;

        $url = Url::create($data);

        return redirect('/');
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Url $url)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Url $url)
    {
        return Inertia::render('Edit', [
            'url' => $url
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUrlRequest $request, Url $url)
    {
        $redirectResponseSafeUrl = $this->checkSafeUrl($request->url);
        if ($redirectResponseSafeUrl) {
            return $redirectResponseSafeUrl;
        }

        $redirectResponseUrlExists = $this->checkIfUrlExists($request->url);
        if ($redirectResponseUrlExists) {
            return $redirectResponseUrlExists;
        }
        
        $data = $request->validated();

        $url->update($data);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Url $url)
    {
        $url->delete();

        return redirect('/');
    }

    private function normalizeUrl($url)
    {
        $parsedUrl = parse_url($url);

        $normalizedUrl = isset($parsedUrl['host']) ? $parsedUrl['host'] : '';
        if (isset($parsedUrl['path'])) {
            $normalizedUrl .= $parsedUrl['path'];
        }
        if (isset($parsedUrl['query'])) {
            $normalizedUrl .= '?' . $parsedUrl['query'];
        }

        $normalizedUrl = str_replace('www.', '', $normalizedUrl);

        return $normalizedUrl;
    }

    private function generateUniqueShortUrl()
    {
        do {
            $shortUrl = Str::random(6);
        } while (Url::where('shortened_url', $shortUrl)->exists());

        return $shortUrl;
    }

    private function checkSafeUrl($url)
    {
        if(!$this->safeBrowsing->isSafeUrl($url)) {
            return Redirect::back()->withErrors(['url' => 'The URL is not safe.']);
        }

        return null;
    }

    private function checkIfUrlExists($url)
    {
        $existingUrl = Url::where('url', $url)->first();
        if ($existingUrl) {
            return Redirect::back()->withErrors(['url' => 'Entered URL: ' . $url . ' already exists in the system.']);
        }

        return null;
    }

}
