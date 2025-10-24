---
transition: fade-out
layout: section
---

# Use `wire:key` for _every_ loop

---

<v-click>

````md magic-move
```blade
@foreach ($this->users as $user)
    <div>{{ $user->name }}</div>
@endforeach
```
```blade
@foreach ($this->users as $user)
    <div :wire:key="$user->id">{{ $user->name }}</div>
@endforeach
```
```blade
@foreach ($this->users as $user)
    <div :wire:key="'user-' . $user->id">{{ $user->name }}</div>
@endforeach
```
````

</v-click>

<!--

- Once upon a time there were 2 developers, Andrew & Andy who were building a to-do app with many nested Livewire components...

- Livewire uses Vue's reactivity engine
- Keys are important to not get weird side effects
- It's hard to debug cause usually there's no error
- So common it's in the Trouble shooting guide
- Example component that shows reactivity bug
  - fix bug by adding key
  - introduce new bug by adding a similar table/list
  - fix by adding prefix
  - show `id()` or `keyFor()`

-->