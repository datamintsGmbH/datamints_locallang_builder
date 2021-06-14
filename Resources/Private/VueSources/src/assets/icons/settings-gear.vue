<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" :width="width" :height="height"><g stroke-miterlimit="10" transform="translate(0.5, 0.5)" :fill="_secondaryfill" :stroke="_secondaryfill"><circle cx="12" cy="12" r="3" fill="none" stroke-linecap="square" stroke-width="1" stroke-linejoin="miter" :stroke="_secondaryfill"></circle> <path d="M20,12a8.049,8.049,0,0,0-.188-1.713l2.714-2.055-2-3.464L17.383,6.094a7.987,7.987,0,0,0-2.961-1.719L14,1H10L9.578,4.375A7.987,7.987,0,0,0,6.617,6.094L3.474,4.768l-2,3.464,2.714,2.055a7.9,7.9,0,0,0,0,3.426L1.474,15.768l2,3.464,3.143-1.326a7.987,7.987,0,0,0,2.961,1.719L10,23h4l.422-3.375a7.987,7.987,0,0,0,2.961-1.719l3.143,1.326,2-3.464-2.714-2.055A8.049,8.049,0,0,0,20,12Z" fill="none" stroke-linecap="square" stroke-width="1" stroke-linejoin="miter" :stroke="fill"></path></g></svg></template>

<script>
export default {
	props: {
		width: {
			type: [Number, String],
			default: "100%"
		},
		height: {
			type: [Number, String],
			default: "100%"
		},
		fill: {
			type: String,
			default: "currentColor"
		},
		secondaryfill: {
			type: String
		}
	},
	computed: {
		_secondaryfill: function () {
			return this.secondaryfill || this.fill
		}
	}
}
</script>