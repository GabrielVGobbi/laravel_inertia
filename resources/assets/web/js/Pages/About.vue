<template>
    <div>
        About Telephone {{celphone}}
        About Index {{index}}
    </div>
</template>

<script>
export default {
    props: {
        celphone: String,
        index: String,
    }
}
</script>