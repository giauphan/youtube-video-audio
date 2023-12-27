<script setup>
import { useToast } from 'vue-toast-notification'
import 'vue-toast-notification/dist/theme-sugar.css'
const $toast = useToast()
$toast.clear()

const { type, body } = defineProps(['type', 'body'])
if (type == 'success') {
  $toast.success(body)
} else if (type == 'error') {
  $toast.error(body)
}
</script>
