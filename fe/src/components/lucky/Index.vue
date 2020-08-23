<template>
    <div>
        <p>Lucky</p>
        <h3>{{ num }}</h3>
    </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'
@Component
export default class Lucky extends Vue {
    @Prop(Number) readonly num!: number
}
</script>

<style lang="less" scoped>
div {
    p {
        font-size: 10px;
    }
}
</style>
