<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FC0204" d="M48,8c0-1.105-0.895-2-2-2H2l46,32V8z"></path> <path d="M2,6C0.895,6,0,6.895,0,8v32c0,1.105,0.895,2,2,2h44c1.105,0,2-0.895,2-2v-2L2,6z"></path> <path fill="#FFFFFF" d="M18.387,28.813l0.57-2.313l-2.021,1.148L14.914,26.5l0.568,2.313l-1.539,1.586h2.105l0.887,1.922 l0.885-1.922h2.105L18.387,28.813z"></path> <path fill="#FFFFFF" d="M10.916,24.016l0.371-1.516l-1.324,0.752L8.635,22.5l0.373,1.516L8,25.059h1.383l0.58,1.26l0.582-1.26h1.381 L10.916,24.016z"></path> <path fill="#FFFFFF" d="M16.916,22.016l0.371-1.516l-1.324,0.752L14.635,20.5l0.373,1.516L14,23.059h1.383l0.58,1.26l0.582-1.26 h1.381L16.916,22.016z"></path> <path fill="#FFFFFF" d="M6.916,28.197l0.371-1.516l-1.324,0.752l-1.328-0.752l0.373,1.516L4,29.24h1.383l0.58,1.26l0.582-1.26h1.381 L6.916,28.197z"></path> <polygon fill="#FFFFFF" points="14.443,36.078 12.338,36.078 11.453,38 10.566,36.078 8.463,36.078 10,34.492 9.432,32.18 11.453,33.326 13.475,32.18 12.904,34.492 "></polygon> <path fill="#FFFF00" d="M40,14h-4v-4h-4c-1.105,0-2,0.895-2,2v2h-4c-1.105,0-2,0.895-2,2h6v2c0,1.105,0.895,2,2,2h4v-4h4v2 c1.105,0,2-0.895,2-2S41.105,14,40,14z"></path></g></svg></template>

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