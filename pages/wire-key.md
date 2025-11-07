---
layout: section
---

# Use `wire:key` for <span v-mark="{ at: 1, color: '#0cbabaBF', type: 'highlight' }">_every_</span> loop

<!--
I'm not kidding, _every_ loop needs a `wire:key`

Don't believe me? Let's look at the docs...
-->

---
layout: center
---

<div class="lw-tip my-6 text-base flex bg-gray-900/75 rounded-md" style="box-shadow: inset 0px -1px 0px rgba(0, 0, 0, 0.5), inset 0px 1px 0px rgba(255, 255, 255, 0.1); width: 700px">
    <div class="py-5">
        <div class="bg-red-300 glow-red-300 w-[3px] h-full rounded-r-lg"></div>
    </div>
    <div class="py-6 px-6 w-full">
        <div class="flex mb-4 justify-between items-center">
            <div class="font-semibold text-xl pt-2">
                Keys aren't optional
            </div>
            <div class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="text-base leading-7 text-gray-300">
            <p>If you have used frontend frameworks like Vue or Alpine, you are familiar with adding a key to a nested element in a loop. However, in those frameworks, a key isn't <em>mandatory</em>, meaning the items will render, but a re-order might not be tracked properly. However, Livewire relies more heavily on keys and will behave incorrectly without them.</p>
        </div>
    </div>
</div>

<!--
Read this out
-->

---
layout: center
---

<img src="/images/once-upon-a-time.webp" alt="Two people with backpacks hike on a trail; one holds a lyre and has colorful hair (Andy Newhouse), the other carries an axe (Andrew Morgan). 'Once upon a time' is written above them, with mountains and trees in the background.">

<!--
Storytime. Once upon a time, there were two developers, Andrew and Andy, who were building a to-do app with many nested Livewire components. When we were playing with the different Livewire components, we would delete one or reorder them or edit one, and the rendering would get all messed up. It took us hours and days to figure out what the problem was. The problem was wire:key. We didn't have wire:keys on our nested Livewire components. If we had just checked the documentation, we probably would have seen this little tidbit about how we needed a wire:key on both the div and the Livewire component, and that would have saved us, at least me, two pipe headaches.
-->

---
layout: center
---

<img src="/images/task-app-ui.webp" class="w-[75%] mx-auto" alt="A simple tldraw of a todo app with nested items. Each row has a checkbox, edit, and delete button. The heading says 'Planning Wire:Live' and rows are 'Things to Book', 'Venue', 'Catering', 'Speakers'">

---
layout: center
---

<img src="/images/nested-keys.webp" alt="A screenshot of a section of the Livewire documentation ">

<div class="absolute h-full w-full inset-0 flex items-end justify-center">
    <a href="https://livewire.laravel.com/docs/3.x/troubleshooting#adding-wirekey" target="_blank" class="text-gray-400 text-sm !border-none">Link</a>
</div>