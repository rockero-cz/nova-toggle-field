<template>
  <div :class="{'cursor-not-allowed': field.readonly}">
    <toggle-button
        v-if="field.toggle"
        @change="toggle"
        :value="value"
        :disabled="field.readonly"
        :sync="true"
        :color="{
          checked: field.trueColor,
          unchecked: field.falseColor,
        }"
      />
    <boolean-icon v-else :value="field.value" />
  </div>
</template>

<script>
export default {
  props: ['resourceName', 'field'],

  data: () => ({
    value: false,
  }),

  mounted() {
    this.value = this.field.value || false
  },

  methods: {
      toggle() {
          this.value = !this.value

          Nova.request().post('/nova-vendor/toggle-field/' + this.resourceName + '/update', {
            value: this.value,
            attribute: this.field.attribute,
            resourceId: this.$parent.resource.id.value,
          })
          .then(() => {
            Nova.success(this.__('The resource was updated!'))
          })
          .catch(() => {
            this.value = !this.value
          })
      },
  },
}
</script>
