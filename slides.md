---
theme: default
background: /images/night-lightning.jpg
title: "Livewire in Production: Avoiding Pitfalls, Applying Best Practices"
info: |
  ## Livewire in Production:
  Avoiding Pitfalls, Applying Best Practices
author: "Andy Newhouse aka TechEnby"
colorSchema: dark
drawings:
  persist: false
transition: slide-left
mdc: true
font:
  serif: BROTHER
  mono: MonoLisa
---

# Livewire in Production:
## Avoiding Pitfalls, Applying Best Practices

<div class="pt-24">
Andy Newhouse aka TechEnby  
(they/them)
</div>

---
transition: fade-out
layout: center
---

# Hey, I'm Andy

<v-clicks depth="2">

- I'm a Lead Programmer @ Tighten
- I'm a big nerd
  - LEGO
  - 3D Printing
  - Band
  - etc.
- I'm Livewire's Biggest Fan __*__{style="font-family: MonoLisa;"}
  - \* Cannot be scientifically proven{style="font-family: MonoLisa; list-style-type: none;"} 

</v-clicks>

<!--
Big Nerd: LEGO, Band, 3D printing and more

Livewire: I've been using Livewire since the beginning, and I freaking love it.
-->

---
transition: swap
layout: image
image: /images/livewire-homepage.png
backgroundSize: contain
---

<!--
Livewire, the whole reason we traveled to this Buffalo place

The most effective...

But more importantly to me, and what got me excited about Livewire at Laracon Chicago was...
-->

---
transition: swap
layout: image
image: /images/livewire-homepage-modified.png
backgroundSize: contain
---

<div class="flex flex-items-center flex-justify-center absolute inset-0">
<h1 v-click class="text-center font-bold bg-pink px-3.5 py-2.5">Without leaving PHP</h1>
</div>

---
layout: image
backgroundSize: contain
---

<div class="flex flex-items-center flex-justify-center absolute inset-0">
<h1 class="text-center font-bold bg-pink px-3.5 py-2.5 text-white">Without leaving PHP</h1>
</div>

<!--
At the time when I started using Livewire I was a single dev working at a company with 
two multi-million dollar music e-commerce stores

I was very interested in simplifying my workflow, and forgetting about Javascript

But as with all things...
-->

---
transition: swap
transition: fade-out
layout: center
---

<div class="relative">
  <img src="/public/images/great-power-still.jpg" alt="First frame from the GIF">

  <img v-click src="/public/images/great-power.gif" alt="Animated GIF" class="absolute inset-0">

  <img v-click src="/public/images/great-power-last-still.jpg" alt="Last frame from the GIF" class="absolute inset-0">
</div>

---
transition: fade-out
layout: center
---


# Be responsible

<v-clicks>

# Principles are important

# The stack is not

</v-clicks>

<!--
If you wouldn't do it when building an API, think twice about doing it in Livewire or Inertia
-->

---
transition: fade-out
layout: center
---

# Andy's Keys to Success

<v-click>

Courtesy of building 100s of Livewire Apps

</v-click>

---
transition: fade-out
layout: center
---

# You must use `wire:key`, no exceptions

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
In Vue.js, keys are crucial for the reactivity engine, particularly in the context of rendering lists of elements.

| Reason                     | Explanation                                                                                          |
|----------------------------|------------------------------------------------------------------------------------------------------|
| Unique Identification      | Keys provide a unique identifier for each item in a list, helping Vue track changes to individual items. |
| Efficient Updates          | When keys are used, Vue can optimize rendering by only re-rendering elements that have changed, rather than the entire list. |
| Preserving State           | Keys help preserve the state of components when items are added, removed, or reordered in a list. This is particularly important for form inputs or animations. |
| Avoiding Rendering Issues   | Without keys, Vue may incorrectly reuse elements, leading to unexpected behavior or bugs in the UI. |

Some of the _hardest_ bugs I've experienced have been because I forgot to add `wire:key` 
-->

---
transition: fade-out
layout: center
---

# Not everything needs to be Livewire

Alpine?

<!--
If you need reactivity or clicking of buttons -> Livewire
If you're not -> Blade
-->

---
transition: fade-out
layout: center
---

# Not everything needs to be on one page

<!--
- Potentially name drop Matt?
- Just because you _can_ doesn't mean you _should_
-->

---
transition: fade-out
layout: center
---

# `$refresh`

> Sometimes you may want to trigger a simple "refresh" of your component. ... You can do this using Livewire's simple `$refresh` action anywhere you would normally reference your own component method

<v-click>
Keyword _simple_
</v-click>

---
transition: fade-out
layout: center
---

# Traits are your friend
# Hiding Properties is not
State should be easily accessible
