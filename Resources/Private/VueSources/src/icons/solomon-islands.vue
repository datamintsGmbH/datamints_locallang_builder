<template><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" :width="width" :height="height"><g><path fill="#FAFD00" d="M4,42H2c-1.105,0-2-0.895-2-2v-4L44,6h2c1.105,0,2,0.895,2,2v4L4,42z"></path> <path fill="#048204" d="M46,42H4l44-30v28C48,41.105,47.105,42,46,42z"></path> <path fill="#040385" d="M2,6h42L0,36V8C0,6.895,0.895,6,2,6z"></path> <polygon fill="#FFFFFF" points="14.518,10.422 12.412,10.422 11.527,8.5 10.641,10.422 8.537,10.422 10.074,12.008 9.506,14.32 11.527,13.174 13.549,14.32 12.979,12.008 "></polygon> <path fill="#FFFFFF" d="M8,17.26H6.619L6.037,16l-0.58,1.26H4.074l1.008,1.043l-0.373,1.516l1.328-0.752l1.324,0.752L6.99,18.303 L8,17.26z"></path> <path fill="#FFFFFF" d="M12,21.441h-1.381l-0.582-1.26l-0.58,1.26H8.074l1.008,1.043L8.709,24l1.328-0.752L11.361,24l-0.371-1.516 L12,21.441z"></path> <path fill="#FFFFFF" d="M20,16.102h-2.105L17.01,14.18l-0.887,1.922h-2.105l1.539,1.586L14.988,20l2.022-1.148L19.031,20 l-0.57-2.312L20,16.102z"></path></g></svg></template>

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