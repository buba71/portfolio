<template>
    <transition-group name="skills-move" tag="div" class="row">
        <div v-for="tool in tools" class="col-6 col-sm-4 col-md-2 text-center" v-bind:key="tool.id">
            <img class="icon-tech" v-bind:src="tool.img">
            <p>{{ tool.name }}</p>
        </div>
    </transition-group>
</template>

<script type="application/ecmascript">

    let i = 0;
    const dataTools = [
        {
            id: 1,
            img: "../../images/ithub.png",
            name: 'GIT'
        },
        {
            id: 2,
            img: "../../images/docker.png",
            name: 'DOCKER'
        },
        {
            id: 3,
            img: "../../images/travis.png",
            name: 'TRAVIS CI'
        },
        {
            id: 4,
            img: "../../images/trello.png",
            name: 'TRELLO'
        },
        {
            id: 5,
            img: "../../images/phpstorm.png",
            name: 'PHPSTORM'
        },
        {
            id: 6,
            img: "../../images/agile.png",
            name: 'Agile/Scrum'
        }

    ];

    export default {
        name: 'tool',
        data: function () {
            return {
                tools: []
            }
        },
        props: {skill: Boolean},
        methods: {
            addSkill: function () {
                if (i < dataTools.length) {
                    this.tools.push(dataTools[i]);
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