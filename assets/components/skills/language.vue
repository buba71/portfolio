<template>
    <transition-group name="skills-move" tag="div" class="row">
        <div v-for="language in languages" class="col-6 col-sm-3 text-center" v-bind:key="language.id">
            <img class="icon-tech" v-bind:src="language.img">
            <p>{{ language.name }}</p>
        </div>
    </transition-group>
</template>

<script type="application/ecmascript">

let i = 0;
const dataLanguages = [
    {
        id: 1,
        img: "../../images/html.png",
        name: 'HTML 5'
    },
    {
        id: 2,
        img: "../../images/css.png",
        name: 'CSS 3'
    },
    {
        id: 3,
        img: "../../images/javascript.png",
        name: 'JAVASCRIPT'
    },
    {
        id: 4,
        img: "../../images/php.png",
        name: 'PHP'
    }
];

export default {
    name: 'language',
    data: function () {
        return {
            languages: []
        }
    },
    props: {skill: Boolean},
    methods: {
        addSkill: function () {
            if (i < dataLanguages.length) {
                this.languages.push(dataLanguages[i]);
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