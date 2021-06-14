<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><polygon fill="#FADC30" points="48,18 12,42 4.789,42 48,13.193 "></polygon> <polygon fill="#FADC30" points="36,6 43.211,6 0,34.807 0,30 "></polygon> <path fill="#3E74BA" d="M2,6h34L0,30V8C0,6.895,0.895,6,2,6z"></path> <path fill="#3E74BA" d="M46,42H12l36-24v22C48,41.105,47.105,42,46,42z"></path> <path fill="#CC162C" d="M4.789,42H2c-1.105,0-2-0.895-2-2v-5.193L43.211,6H46c1.105,0,2,0.895,2,2v5.193L4.789,42z"></path> <path fill="#F6D031" d="M12.256,10.617H9.348l-1.22-2.648l-1.222,2.648H4l2.124,2.193L5.338,16l2.79-1.584L10.918,16l-0.786-3.189 L12.256,10.617z"></path></g></svg></template>

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