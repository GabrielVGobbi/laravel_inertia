<template>
    <div class="mt-4">
        <InertiaLink href="/" class="btn btn-primary"> Home </InertiaLink>
        <InertiaLink href="/about" class="btn btn-primary"> About </InertiaLink>
    </div>
    
    <div>
        <slot></slot>
    </div>
</template>

<script>
export default {};
</script>