<template>
    <transition-group name="skills-move" tag="div" class="row">
        <div v-for="framework in frameworks" class="col-6 col-sm-4 text-center" v-bind:key="framework.id">
            <img class="icon-tech" v-bind:src="framework.img">
            <p>{{ framework.name }}</p>
        </div>
    </transition-group>
</template>

<script type="application/ecmascript">

let i = 0;
const dataFrameworks = [
    {
        id: 1,
        img: "../../images/bootstrap.png",
        name: 'Bootstrap 4'
    },
    {
        id: 2,
        img: '../../images/vue.png',
        name: 'Vue.js'
    },
    {
        id: 3,
        img: '../../images/symfony.png',
        name: 'Symfony 4'
    }
];


    export default {
        name: 'framework',
        data: function () {
            return {
                frameworks: []
            }
        },
        props: {skill: Boolean},
        methods: {
            addSkill: function () {
                if (i < dataFrameworks.length) {
                    this.frameworks.push(dataFrameworks[i]);
                    setTimeout(this.addSkill, 300);
                    i++;
                }
            }
        },
        watch: {
            skill: function () {
                this.addSkill();

            }
        }

    }
</script>