---
theme: ./theme
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
transition: swap
layout: image
image: /images/livewire-homepage.png
backgroundSize: contain
---

<!--
Livewire, the whole reason we traveled to this Buffalo place

The most productive way to build your next web app

But more importantly to me, and what got me excited about Livewire was...
-->

---
transition: swap
layout: image
image: /images/livewire-homepage-modified.png
backgroundSize: contain
---

<div class="flex flex-items-center flex-justify-center absolute inset-0 -rotate-5">
<h1 v-click class="text-center font-bold bg-pink px-3.5 py-2.5 -mt-12">Without leaving PHP</h1>
</div>

<!--
Powerful, dynamic, front-end UIs without leaving PHP.

The key phrase for me is...

"without ...
-->

---

<div class="flex flex-items-center flex-justify-center absolute inset-0 -rotate-5">
<h1 class="text-center font-bold bg-pink px-3.5 py-2.5 text-white -mt-12">Without leaving PHP</h1>
</div>

<!--
... leaving PHP"

More on that later, but first...
-->

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
I'm a big nerd, just like all of you.

...

I have a LEGO city in my basement...
My spouse and I print all sorts of fidgets...
I'm in 2 local queer community bands where I play clarinet and trumpet...
There's more, but John'll kill me if I go over 

But most importantly...

I'm Livewire's Biggest Fan..., and have been since 2018...
-->

---

# My History with Livewire

---
layout: image
backgroundSize: 80%
image: /images/embrace-the-backend-thumbnail.jpg
---

<!--
Who remembers this talk from Laracon 2018?
-->

---
layout: image
backgroundSize: 60%
image: /images/embrace-the-backend-iconic-slide.png
---

<!--
Or remembers this iconic slide?
-->

---
layout: image
backgroundSize: 80%
image: /images/origin-of-livewire.png
---

<!--
The first comment under the YouTube video says: "This speech should be named "The Origin of Livewire", which is totally true! 

And this talk is when I became a fan.
-->

---

# My History with Livewire

-- convert bullet points to horizontal timeline -- 

- July 2018, Laracon US in Chicago - Embrace the Backend
- July 2019, Laracon US in NYC - Introducing: Livewire
- February 2020, Livewire v1 released
- March 2020, `composer require livewire/livewire`

---
transition: fade-out
layout: center
---

# Andy's Keys to Success

<v-click>

Courtesy of building 100s of Livewire Apps

</v-click>

<!--

Let's start off with an easy one that I promise will save you 2-5 headaches...

-->

---
transition: fade-out
layout: center
---

# Use `wire:key` for _every_ loop

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



---
transition: swap
transition: fade-out
layout: center
---

<div class="relative">
  <img src="/images/great-power-still.jpg" alt="First frame from the GIF">

  <img v-click src="/images/great-power.gif" alt="Animated GIF" class="absolute inset-0">

  <img v-click src="/images/great-power-last-still.jpg" alt="Last frame from the GIF" class="absolute inset-0">
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
