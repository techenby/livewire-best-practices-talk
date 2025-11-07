---
layout: section
---

# Use the right tool for the job

<v-click>

## Not everything needs to be Livewire

</v-click>

<!--
Trust me, my compulsion to have _everything_ be the same makes me want everything to be Livewire... but most times plain 'ol blade will work fine.

For example...
-->

---

```php
class Courses extends Component
{
    public Collection $courses;
    
    public function mount(): void
    {
        $this->courses = Course::query()
            ->with('meetings')
            ->withCount('students')
            ->get();
    }
}
```

<v-clicks>

__Course:__ classes, i.e. Math 101

__Meetings:__ when the course meets, i.e. Monday & Wednesday, 9 - 10:30 am

__Students:__ list of people in class

</v-clicks>

<!--
Lets take a look at an example of a component that lists courses in a teacher's schedule for a week.

And just to give a little context on this mount method, a course...

meetings...

students...
-->

---

````md magic-move 
```blade
{{-- livewire/courses.blade.php --}}
<flux:table>
    <flux:table.columns>
        <flux:table.column>Grade</flux:table.column>
        <flux:table.column>Homeroom</flux:table.column>
        <flux:table.column>Meets</flux:table.column>
        <flux:table.column># Students</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($this->courses as $course)
            <flux:table.row wire:key="$course->id">
                <flux:table.cell class="flex gap-2 items-center">
                    <x-color-dot :background="$course->color->background()" />
                    <span>{{ $course->grade }}</span>
                </flux:table.cell>
                <flux:table.cell>{{ $course->homeroom }}</flux:table.cell>
                <flux:table.cell>{{ $course->meets }}</flux:table.cell>
                <flux:table.cell>{{ $course->students_count }}</flux:table.cell>
            </flux:table.row>
        @endforeach
    </flux:table.rows>
</flux:table>
```
```blade 
{{-- livewire/courses.blade.php --}}
<flux:table>
    <flux:table.columns>
        <flux:table.column>Grade</flux:table.column>
        <flux:table.column>Homeroom</flux:table.column>
        <flux:table.column>Meets</flux:table.column>
        <flux:table.column># Students</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($this->courses as $course)
            <livewire:courses.row :$course wire:key="$course->id" />
        @endforeach
    </flux:table.rows>
</flux:table>
```
```blade
{{-- livewire/courses/row.blade.php --}}
<flux:table.row wire:key="$course->id">
    <flux:table.cell class="flex gap-2 items-center">
        <x-color-dot :background="$course->color->background()" />
        <span>{{ $course->grade }}</span>
    </flux:table.cell>
    <flux:table.cell>{{ $course->homeroom }}</flux:table.cell>
    <flux:table.cell>{{ $course->meets }}</flux:table.cell>
    <flux:table.cell>{{ $course->students_count }}</flux:table.cell>
</flux:table.row>
```
```blade 
{{-- livewire/courses.blade.php --}}
<flux:table>
    <flux:table.columns>
        <flux:table.column>Grade</flux:table.column>
        <flux:table.column>Homeroom</flux:table.column>
        <flux:table.column>Meets</flux:table.column>
        <flux:table.column># Students</flux:table.column>
    </flux:table.columns>

    <flux:table.rows>
        @foreach ($this->courses as $course)
            <x-courses.row :$course wire:key="$course->id" />
        @endforeach
    </flux:table.rows>
</flux:table>
```
````

<!--
Here's the view that the component renders, which lists out all the courses for a teacher.

For a long time, my tendency was to componentize _everything_ which would lead me to...

Create a component for that row...

But does this row really need its own component? It's not _doing_ anything, it's not "live"

Instead, we can make it a _blade_ component which doesn't come with the overhead of Livewire's reactivity.

And if we look at the docs...
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

<!--
It says...
-->

---
layout: image
image: ./images/extensible-blade-components.webp
backgroundSize: 80%
---

<div class="absolute h-full w-full inset-0 flex items-end justify-center">
    <a href="https://tighten.com/insights/extensible-blade-components/" target="_blank" class="text-gray-400 text-sm !border-none">Link</a>
</div>

<!--
This post by Marcus Moore does a really good job of talking about how to extract blade components
-->

---
layout: section
---

# Let's not forget Alpine...

<!--
I know I really should talk about using Alpine instead of PHP for things... but honestly I got into Livewire to AVOID javascript
-->

---
layout: image
image: ./images/optimistic-ui.webp
backgroundSize: 80%
---

<div class="absolute h-full w-full inset-0 flex items-end justify-center">
    <a href="https://tighten.com/insights/optimistic-ui-tips-livewire-alpine/" target="_blank" class="text-gray-400 text-sm !border-none">Link</a>
</div>

<!--
So for a really awesome walk through on using Livewire and Alpine to make optomisic UI's check out this post by Tony and Omar
-->