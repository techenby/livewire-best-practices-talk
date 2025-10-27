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
