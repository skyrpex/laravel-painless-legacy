<?php

namespace Pallares\LaravelPainlessLegacy\Http;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Foundation\Validation\ValidationException;

class HttpServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerValidateMacro();
    }

    /**
     * Register the "validate" macro on the request.
     *
     * @return void
     */
    public function registerValidateMacro()
    {
        Request::macro('validate', function (array $rules, array $messages = [], array $customAttributes = []) {
            /** @var Request $this */

            /** @var Factory $factory */
            $factory = app(Factory::class);

            /** @var \Illuminate\Contracts\Validation\Validator $validator */
            $validator = $factory->make($this->all(), $rules, $messages, $customAttributes);

            if ($validator->fails()) {
                throw new ValidationException($validator, new JsonResponse($validator->errors()->getMessages(), 422));
            }

            return $this->only(collect($rules)->keys()->map(function ($rule) {
                return str_contains($rule, '.') ? explode('.', $rule)[0] : $rule;
            })->unique()->toArray());
        });
    }
}
