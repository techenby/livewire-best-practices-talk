---
layout: section
---

# Keep Sinks in the Kitchen

---

# Not Everything Needs to Be a Public Property

## Sometimes the best Livewire optimization is <span x-mark>_not_</span> adding more state.

<!--
I see a lot of Livewire components where every variable is declared as a public property.  
But public properties come with overhead — they’re serialized on every request.  
Often, you don’t need them at all.
-->

---

Let's revisit an old component

````md magic-move 
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
```php
class Dashboard extends Component
{   
    ... 
    
    public function render()
    {
        return view('dashboard')
            ->with([
                'courses' => Course::query()
                    ->with('meetings')
                    ->withCount('students')
                    ->get(),
                'staff' => User::all(),
                'students' => Student::all(),
                'meetings' => Meeting::all(), 
            ]);
    }
    
    // actions for filtering, sorting, etc.
}
```
```php
class Dashboard extends Component
{   
    public Collection $courses;
    public Collection $staff;
    public Collection $students;
    public Collection $meetings;
    
    public function mount()
    {   
        $this->courses = Course::query()
            ->with('meetings')
            ->withCount('students')
            ->get(),
        $this->staff = User::all(),
        $this->students = Student::all(),
        $this->meetings = Meeting::all(), 
    }
    
    // actions for filtering, sorting, etc.
}
```
```php
class Dashboard extends Component
{   
    #[Computed]
    public function courses()
    {   
        return Course::query()
            ->with('meetings')
            ->withCount('students')
            ->get(); 
    }
    
    #[Computed]
    public function staff()
    {   
        return User::all(); 
    }
    
    #[Computed]
    public function students()
    {   
        return Student::all(); 
    }
    
    #[Computed]
    public function meetings()
    {   
        return Meeting::all(); 
    }
    
    // actions for filtering, sorting, etc.
}
```
````

<!--
As it is, this component probably wouldn't cause you problems, but what if the component was instead... 

Depending on how large these various collections are this can be a lot of data we're sending to the front end.
And anything that changes the front end will re-run all these queries.

if we convert it to a mount method it's better... but we've introduced a new problem, 
now all that data will only be queried once aaaannnndddd will be sent to the frontend 
on every update because they're all public properties and all now can be modified but 
honestly on a dashboard are you really editing individual models?

Enter Computed properties... honestly I probably over use these, but they're awesome because they cache the query per request

Accessing a method as a computed property offers a performance advantage over calling a method. Internally, when a computed property is executed for the first time, Livewire caches the returned value. This way, any subsequent accesses in the request will return the cached value instead of executing multiple times.

And you bust the cache by just running `unset($this->meetings)`
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
                Computed properties are only cached for a single request
            </div>
            <div class="text-gray-700">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-9 h-9">
                    <path fill-rule="evenodd" d="M9.401 3.003c1.155-2 4.043-2 5.197 0l7.355 12.748c1.154 2-.29 4.5-2.599 4.5H4.645c-2.309 0-3.752-2.5-2.598-4.5L9.4 3.003zM12 8.25a.75.75 0 01.75.75v3.75a.75.75 0 01-1.5 0V9a.75.75 0 01.75-.75zm0 8.25a.75.75 0 100-1.5.75.75 0 000 1.5z" clip-rule="evenodd"></path>
                </svg>
            </div>
        </div>
        <div class="text-base leading-7 text-gray-300">
            <p>It's a common misconception that Livewire caches computed properties for the entire lifespan of your Livewire component on a page. However, this isn't the case. Instead, Livewire only caches the result for the duration of a single component request. This means that if your computed property method contains an expensive database query, it will be executed every time your Livewire component performs an update.</p>
        </div>
    </div>
</div>

---

````md magic-move 
```php
class Dashboard extends Component
{   
    #[Computed]
    public function courses()
    {   
        return Course::query()
            ->with('meetings')
            ->withCount('students')
            ->get(); 
    }
    
    ...
}
```
```php
class Dashboard extends Component
{   
    #[Computed(persist: true)]
    public function courses()
    {   
        return Course::query()
            ->with('meetings')
            ->withCount('students')
            ->get(); 
    }
    
    ...
}
```
````

---
layout: section
---

# Well actually...

<!--
I'd probably break these out into different components and in v4 use islands or Lazy rendering to better handle state
-->