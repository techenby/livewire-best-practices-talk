---
layout: section
---

# Quick Tips

---
layout: center
---

# Use `$refresh` sparingly

<v-clicks>

- Forces a **full component re-render** — heavy and often unnecessary
- Instead:
    - Use events to update only what changed
    - Or rely on computed properties and unset them
- Think of `$refresh` like `!important` in CSS — handy, but last resort

</v-clicks>

---
layout: center
---

# Extract shared logic into Traits

<v-clicks depth="3">

- Keeps components focused and readable
- Great for repeated patterns like:
    - Sorting → `WithSorting`
    - Filters → `WithFilters`
    - Pagination → `WithPagination`
      - oh wait this comes with Livewire

</v-clicks>


---

```php
trait WithDataTable
{
    public $perPage = 10;
    public $search = '';
    public $sortBy = '';
    public $sortDirection = 'desc';

    public function sort($column)
    {
        $this->resetPage();

        if ($this->sortBy === $column && $this->sortDirection === 'asc') {
            $this->reset('sortBy', 'sortDirection');
        } elseif ($this->sortBy === $column) {
            $this->sortDirection = 'asc';
        } else {
            $this->sortBy = $column;
            $this->sortDirection = 'desc';
        }
    }

    public function updatedSearch()
    {
        $this->resetPage();
    }
}
```

<!-- 
Here's an example of a trait I made in my LifeOS app Sunny, TBH I can't decide if trait props should or shouldn't be in the trait. But for now I'm thinking of them as sensible defaults.
-->

---
layout: section
---

# Don’t forget test!

---
layout: center
---

# Normal Test

```php
test('can delete course', function () {
    $course = Course::factory()
        ->has(
            CourseMeeting::factory()
                ->count(2)
                ->sequence(
                    ['day' => Day::MONDAY, 'period' => Period::FIRST],
                    ['day' => Day::THURSDAY, 'period' => Period::FIRST],
                ), 'meetings')
        ->grade(Grade::FIRST)
        ->color(Color::RED)
        ->create(['homeroom' => 123]);

    [$meetingA, $meetingB] = $course->meetings;

    Livewire::test(Index::class)
        ->call('delete', $this->course->id)
        ->assertDontSee('1st Grade')
        ->assertSee('2nd Grade');

    expect($this->course->fresh())->toBeNull()
        ->and($meeting->fresh())->toBeNull()
        ->and($meeting->fresh())->toBeNull();
});
```

<!--
I don't want to spend a ton of time on this because JMac is up next, but

I can’t tell you how many times I’ve shipped a feature, ran the test suite, felt great —  
then clicked the button in the browser and… nothing.  
Turns out I forgot `wire:click`.
-->

---
layout: center
---

# Pest v4 Browser Testing

```php
test('can delete course', function () {
    $course = Course::factory()
        ->has(
            CourseMeeting::factory()
                ->count(2)
                ->sequence(
                    ['day' => Day::MONDAY, 'period' => Period::FIRST],
                    ['day' => Day::THURSDAY, 'period' => Period::FIRST],
                ), 'meetings')
        ->grade(Grade::FIRST)
        ->color(Color::RED)
        ->create(['homeroom' => 123]);

    $this->actingAs(User::factory()->create());

    visit(route('courses', ['tab' => 'list']))
        ->click("#course-{$course->id}-actions")
        ->click("#course-{$course->id}-delete")
        ->assertDontSee('1st Grade');
});
```

---
layout: image
backgroundSize: contain
image: ./images/test-driven-laravel.webp
---

<!--
Thank you Adam Wathan for teaching me how to test! How many of you learned TDD from that course?
-->