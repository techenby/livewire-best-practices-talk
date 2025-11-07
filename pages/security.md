---
layout: section
---

# Keeping your app and users safe

<!--
I knew I needed to include this section... but really I've tended to be pretty YAGNI
-->

---
layout: center
---

```php
Route::get('/posts/{id}', ShowPost::class)->middleware('can:view,post');
```

<!--

-->

---

````md magic-move
```php
class ShowPost extends Component
{
    public $id;
 
    public function mount($postId)
    {
        $this->id = $postId;
    }
}
```
```php
class ShowPost extends Component
{
    #[Locked]
    public $id;
 
    public function mount($postId)
    {
        $this->id = $postId;
    }
}
```
````

<!--
Because public properties are public they can be modified from the frontend. So you should add the Locked property to things that shouldn't be changed from the client side.
-->

---
layout: section
---

# Who forgets to use  
# `#[Locked]`?

<!--
I know I do...
-->

---
layout: section
---

# Who uses full page components?

---
layout: center
---

<div class="lw-tip my-6 text-base flex bg-gray-900/75 rounded-md" style="box-shadow: inset 0px -1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.1); width: 700px;">
    <div class="py-5">
        <div class="bg-teal-300 glow-teal-300 w-[3px] h-full rounded-r-lg"></div>
    </div>
    <div class="py-6 px-6 w-full">
                    <div class="flex mb-4 justify-between items-center">
                <div class="font-semibold text-xl pt-2">
                    Model properties are secure by default
                </div>
                <div class="text-gray-700">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-8 h-8">
            <path fill-rule="evenodd" d="M9 4.5a.75.75 0 01.721.544l.813 2.846a3.75 3.75 0 002.576 2.576l2.846.813a.75.75 0 010 1.442l-2.846.813a3.75 3.75 0 00-2.576 2.576l-.813 2.846a.75.75 0 01-1.442 0l-.813-2.846a3.75 3.75 0 00-2.576-2.576l-2.846-.813a.75.75 0 010-1.442l2.846-.813A3.75 3.75 0 007.466 7.89l.813-2.846A.75.75 0 019 4.5zM18 1.5a.75.75 0 01.728.568l.258 1.036c.236.94.97 1.674 1.91 1.91l1.036.258a.75.75 0 010 1.456l-1.036.258c-.94.236-1.674.97-1.91 1.91l-.258 1.036a.75.75 0 01-1.456 0l-.258-1.036a2.625 2.625 0 00-1.91-1.91l-1.036-.258a.75.75 0 010-1.456l1.036-.258a2.625 2.625 0 001.91-1.91l.258-1.036A.75.75 0 0118 1.5zM16.5 15a.75.75 0 01.712.513l.394 1.183c.15.447.5.799.948.948l1.183.395a.75.75 0 010 1.422l-1.183.395c-.447.15-.799.5-.948.948l-.395 1.183a.75.75 0 01-1.422 0l-.395-1.183a1.5 1.5 0 00-.948-.948l-1.183-.395a.75.75 0 010-1.422l1.183-.395c.447-.15.799-.5.948-.948l.395-1.183A.75.75 0 0116.5 15z" clip-rule="evenodd"></path>
        </svg>
                </div>
            </div>
        <div class="text-base leading-7 text-gray-300">
            <p>If you store an Eloquent model in a public property instead of just the model's ID, Livewire will ensure the ID isn't tampered with, without you needing to explicitly add the <code>#[Locked]</code> attribute to the property. For most cases, this is a better approach than using <code>#[Locked]</code>:</p>
<pre><code data-theme="material-theme-palenight" data-lang="php" class="torchlight has-highlight-lines" style="background-color: #292D3E; --theme-selection-background: #00000080;"><!-- Syntax highlighted by torchlight.dev --><div class="line"><span style="color: #C792EA;">class</span><span style="color: #A6ACCD;"> </span><span style="color: #FFCB6B;">ShowPost</span><span style="color: #A6ACCD;"> </span><span style="color: #C792EA;">extends</span><span style="color: #A6ACCD;"> </span><span style="color: #FFCB6B;">Component</span></div><div class="line"><span style="color: #89DDFF;">{</span></div><div class="line line-highlight line-has-background" style="background-color: #00000050"><span style="color: #A6ACCD;">   </span><span style="color: #C792EA;">public</span><span style="color: #A6ACCD;"> </span><span style="color: #FFCB6B;">Post</span><span style="color: #A6ACCD;"> </span><span style="color: #89DDFF;">$</span><span style="color: #A6ACCD;">post</span><span style="color: #89DDFF;">;</span><span style="color: #A6ACCD;"> </span></div><div class="line">&nbsp;</div><div class="line"><span style="color: #A6ACCD;">   </span><span style="color: #C792EA;">public</span><span style="color: #A6ACCD;"> </span><span style="color: #C792EA;">function</span><span style="color: #A6ACCD;"> </span><span style="color: #82AAFF;">mount</span><span style="color: #89DDFF;">($</span><span style="color: #A6ACCD;">postId</span><span style="color: #89DDFF;">)</span></div><div class="line"><span style="color: #A6ACCD;">   </span><span style="color: #89DDFF;">{</span></div><div class="line"><span style="color: #A6ACCD;">       </span><span style="color: #89DDFF;">$this-&gt;</span><span style="color: #A6ACCD;">post </span><span style="color: #89DDFF;">=</span><span style="color: #A6ACCD;"> </span><span style="color: #FFCB6B;">Post</span><span style="color: #89DDFF;">::</span><span style="color: #82AAFF;">find</span><span style="color: #89DDFF;">($</span><span style="color: #A6ACCD;">postId</span><span style="color: #89DDFF;">);</span></div><div class="line"><span style="color: #A6ACCD;">   </span><span style="color: #89DDFF;">}</span></div><div class="line">&nbsp;</div><div class="line"><span style="color: #89DDFF;">  </span><span style="color: #676E95;">// ...</span></div><div class="line"><span style="color: #89DDFF;">}</span></div></code></pre>
        </div>
    </div>
</div>

---
layout: image
backgroundSize: contain
image: ./images/mostly-technical.webp
---

---
layout: image
backgroundSize: contain
image: ./images/stephen-rees-carter.webp
---

---
layout: section
---

# Duplicating Authorization 
# isn't bad

---
layout: center
---

<v-clicks>

- Authorize routes
- Authorize mounts
- Authorize methods
- Save your 🍑

</v-clicks>
