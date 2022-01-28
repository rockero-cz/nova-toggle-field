<template>
  <default-field :field="field" :errors="errors" :show-help-text="showHelpText">
    <div slot="field" :class="{'cursor-not-allowed': field.readonly}">
      <toggle-button
        class="mt-1"
        @change="toggle"
        :id="field.attribute"
        :name="field.name"
        :value="checked"
        :disabled="isReadonly"
        :sync="true"
        :color="{
          checked: field.trueColor,
          unchecked: field.falseColor,
        }"
      />
    </div>
  </default-field>
</template>

<script>
import { FormField, HandlesValidationErrors } from 'laravel-nova'

export default {
  mixins: [HandlesValidationErrors, FormField],

  data: () => ({
    value: false,
  }),

  mounted() {
    this.value = this.field.value || false

    this.field.fill = formData => {
      formData.append(this.field.attribute, this.trueValue)
    }
  },

  methods: {
    toggle() {
      this.value = !this.value
    },
  },

  computed: {
    checked() {
      return Boolean(this.value)
    },

    trueValue() {
      return +this.checked
    },
  },
}
</script>
