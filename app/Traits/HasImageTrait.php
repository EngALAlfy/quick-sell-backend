<?php
/*
 * Project: sunny-backend
 * File: HasImageTrait.php
 * Author: Islam alalfy
 * Company: alalfy.com
 * Website: https://alalfy.com
 * GitHub: https://github.com/EngALAlfy/sunny-backend
 *
 * Copyright (c) 2023 Islam alalfy. All rights reserved.
 * This code is private and confidential.
 * Unauthorized copying or distribution of this file is strictly prohibited.
 */

namespace App\Traits;

trait HasImageTrait {
    public function getImageUrlAttribute(): string
    {
        return $this->image == null ? asset($this->placeholder ?? "assets/admin/img/placeholder.jpg") : asset("/storage/images") . "/" . $this->image ;
    }

    public function getImageNameAttribute(){
        return $this->image;
    }

    public function getImageHtmlAttribute(): string
    {
        return <<<End
                  <img width="100" height="100" src="$this->imageUrl" class="img-thumbnail" alt="$this->imageName">
                End;
    }
}
