<template>
    <div class="slidev-layout split">
        <slot />

        <div class="grid grid-cols-2 gap-4 mt-8">
            <div class="left">
            <slot name="left" />
            </div>
            <div class="right">
            <slot name="right" />
            </div>
        </div>
    </div>
</template>
