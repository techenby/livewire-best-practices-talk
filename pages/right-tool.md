---
layout: section
---

# Use the right tool for the job
## Not everything needs to be Livewire

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
                You might not need a Livewire component
            </div>
            <div class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="text-base leading-7 text-gray-300">
            <p>Before you extract a portion of your template into a nested Livewire component, ask yourself: Does this content in this component need to be "live"? If not, we recommend that you create a simple <a href="https://laravel.com/docs/blade#components">Blade component</a> instead. Only create a Livewire component if the component benefits from Livewire's dynamic nature or if there is a direct performance benefit.</p>
        </div>
    </div>
</div>

---