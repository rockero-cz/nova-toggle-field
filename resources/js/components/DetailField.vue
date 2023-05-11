<template>
    <PanelItem :index="index" :field="field">
        <icon
            v-if="field.value"
            slot="value"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            type="check-circle"
            :style="{
                'color': field.trueColor
            }"
        />
        <icon
            v-else
            slot="value"
            viewBox="0 0 24 24"
            width="24"
            height="24"
            type="x-circle"
            :style="{
                'color': field.falseColor
            }"
        />
    </PanelItem>
</template>

<script>
export default {
    props: ['resource', 'resourceName', 'resourceId', 'field'],

    computed: {
        label() {
            return this.field.value == true ? this.__('Yes') : this.__('No')
        },
    },
}
</script>
