<template>
    <transition name="scrollButton">
        <a href="#" v-scroll-to="'#logo'">
            <i class="fa fa-angle-up fa-3x fa-inverse" id="scroll-return"></i>
        </a>
    </transition>
</template>

<script type="application/ecmascript">

export default {
    name: 'scrollButton',
}

</script>

