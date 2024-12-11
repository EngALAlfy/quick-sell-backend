<li class="nav-item" role="presentation">
    @isset($category)
        <button wire:click.prevent="$set('categoryId' , {{$category->id}})" @class(["nav-link" , "active" => $categoryId == $category->id]) id="category-{{$category->id}}">
            {{$category->name}}
        </button>
    @else
        <button wire:click.prevent="$set('categoryId' , 0)" @class(["nav-link" , "active" => $categoryId == 0]) id="category-0">
            {{__("All")}}
        </button>
    @endisset
</li>
