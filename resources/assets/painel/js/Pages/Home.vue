<template>
    <div>
        <ul>
            <li v-for="(item, index) in users" :key="index">
                {{item.name}}
            </li>
        </ul>
    </div>

   
</template>

<script>
export default {
    props: {
        users: Object
    }
}
</script>

<style>
    ul {
        font-size: 40px;
    }
</style>