<?php

use App\Models\StoreSetting;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

if (!function_exists('upload_file')) {
    function upload_file(UploadedFile $file, bool $advanced = false): string|array
    {
        $file_name = Time() . "-" . $file->getClientOriginalName();
        $dir_name = "files";
        $path = $file->storePubliclyAs($dir_name, $file_name, 'public');
        if ($advanced) {
            return [
                "file_name" => $file_name,
                "storage_path" => storage_path("app/public/$path"),
                "public_path" => asset("storage/$path"),
            ];
        }

        return $file_name;
    }
}

if (!function_exists('update_media')) {
    function update_media(array $data, HasMedia $model, string $attr, string $collection = "images", bool $replace = true): bool
    {
        try {
            if (array_key_exists($attr, $data) && isset($data[$attr])) {
                if (is_numeric($data[$attr])) {
                    if ($data[$attr] == "-1") {
                        $model->media()->where('collection_name', $collection)->delete();
                    } else {
                        $mediaId = $data[$attr];
                        if ($replace) {
                            $model->media()->where('id', '!=', $mediaId)->where('collection_name', $collection)->delete();
                        }
                        $media = Media::query()->find($mediaId);
                        $media?->move($model, $collection);
                    }
                } else {
                    if ($replace) {
                        $model->media()->where('collection_name', $collection)->delete();
                    }
                    $model->addMedia($data[$attr])
                        ->toMediaCollection($collection);
                }
            }
        } catch (Exception $e) {
            return false;
        }
        return true;
    }
}

if (!function_exists('getUserAgent')) {
    /**
     * @throws \UAParser\Exception\FileNotFoundException
     */
    function getUserAgent(): array
    {
        $agent = \UAParser\Parser::create()->parse(request()->userAgent());
        return [
            "ip" => getIp(),
            "device" => $agent->device->toString(),
            "os" => $agent->os->toString(),
            "browser" => $agent->ua->toString(),
        ];
    }
}

if (!function_exists('getIp')) {
    function getIp(): ?string
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return the server IP if the client IP is not found using this method.
    }
}
if (!function_exists('getOnlyClassName')) {

    function getOnlyClassName($fullClassName, $isSnake = true)
    {
        $modelNames = preg_split('/\\\\/', $fullClassName);
        if ($isSnake) {
            return Str::snake(end($modelNames));
        }
        return end($modelNames);

    }
}

if (!function_exists('getBadgeColumn')) {
    /**
     * generate bade column for datatable
     * @param string $text
     * @param string $type
     * @return string
     */
    function getBadgeColumn(string $text = '', string $type = "success"): string
    {
        if (empty($text)) {
            return "<span class='badge bg-label-secondary'> --- </span>";
        }
        return "<span class='badge bg-label-" . $type . "'>" . $text . "</span>";
    }
}

if (!function_exists('getBooleanColumn')) {
    /**
     * generate boolean column for datatable
     * @param $column
     * @param $attributeName
     * @param bool $flip
     * @return string
     */
    function getBooleanColumn($column, $attributeName, bool $flip = false): string
    {
        if (isset($column)) {
            if ($flip) {
                if ($column[$attributeName]) {
                    return "<span class='badge bg-label-danger'>" . trans('Yes') . "</span>";
                }

                return "<span class='badge bg-label-success'>" . trans('No') . "</span>";
            }

            if ($column[$attributeName]) {
                return "<span class='badge bg-label-success'>" . trans('Yes') . "</span>";
            }

            return "<span class='badge bg-label-danger'>" . trans('No') . "</span>";
        }

        return "";
    }
}

if (!function_exists('getPriceColumn')) {
    /**
     * generate bade column for datatable
     * @param float $price
     * @param string $currency
     * @return string
     */
    function getPriceColumn(float $price = 0, string $currency = "LE"): string
    {
        return "<span>" . $price . " " . $currency . "</span>";
    }
}

if (!function_exists('getImageColumn')) {
    /**
     * generate bade column for datatable
     * @param string|null $url
     * @param int $dimensions
     * @return string
     */
    function getImageColumn(?string $url = "", int $dimensions = 50): string
    {
        if (empty($url)) {
            $url = asset("assets/admin/img/placeholder.jpg");
        }
        return "<img src='$url' class='rounded' style='width:{$dimensions}px; height: {$dimensions}px;object-fit: cover;'>";
    }
}


if (!function_exists('hint_icon')) {
    /**
     * generate tooltip icon with hint
     * @param $title
     * @return string
     */
    function hint_icon($title): string
    {
        return <<<HTML
                    <i class="bx bx-info-circle bx-xs"
                       data-bs-toggle="tooltip"
                       data-bs-placement="top"
                       aria-label="$title"
                       data-bs-original-title="$title"></i>
               HTML;
    }
}
if (!function_exists('show_more_text')) {
    /**
     * generate show more text to split unnecessary text
     * @param $text
     * @param int $length
     * @return string
     */
    function show_more_text($text, $length = 20): string
    {
        $showMoreText = __('Show more');
        $showLessText = __('Show less');

        // Trim the text to the specified length
        $trimmedText = mb_substr($text, 0, $length);
        // Check if the text needs to be trimmed
        $showMoreLink = (mb_strlen($text) > $length) ? '<br><a href="#" id="show-more-link" onclick="toggleText(this)">' . $showMoreText . '</a>' : '';

        return <<<HTML
                    <span id="long-text">
                        <span class="show-more-text">
                            $trimmedText
                            <span class="more-text" style="display:none;">$text</span>
                            $showMoreLink
                        </span>
                    </span>

                    <script>
                    function toggleText(link) {
                        var showMoreText = link.parentElement;
                        var moreText = showMoreText.querySelector('.more-text');
                        var showMoreLink = link;

                        if (showMoreLink.textContent.trim() === "$showMoreText") {
                            // Expand the text
                            moreText.style.display = 'inline';
                            showMoreLink.textContent = "$showLessText";
                        } else {
                            // Collapse the text
                            moreText.style.display = 'none';
                            showMoreLink.textContent = "$showMoreText";
                        }
                    }
                    </script>
               HTML;
    }
}


if (!function_exists('store_setting')) {
    /**
     * get Store setting value
     * @param int $store_id
     * @param $key
     * @param mixed $default
     * @return mixed
     */
    function store_setting(int $store_id, $key, mixed $default = null): mixed
    {
        return StoreSetting::query()->where("store_id", $store_id)->where("setting", $key)->value("value") ?? $default;
    }
}

if (!function_exists('save_store_setting')) {
    /**
     * save Store setting value
     * @param int $store_id
     * @param $key
     * @param null $value
     * @param null $options
     * @return mixed
     */
    function save_store_setting(int $store_id, $key, $value = null, $options = null): mixed
    {
        return StoreSetting::query()->updateOrCreate(
            ["store_id" => $store_id, "setting" => $key],
            ["store_id" => $store_id, "setting" => $key, "value" => $value, "options" => $options,]
        );
    }
}

if (!function_exists('store_setting_options')) {
    /**
     * get Store setting value
     * @param int $store_id
     * @param $key
     * @param mixed $default
     * @return mixed
     */
    function store_setting_options(int $store_id, $key, mixed $default = null): mixed
    {
        return StoreSetting::query()->where("store_id", $store_id)->where("setting", $key)->value("options") ?? $default;
    }
}
