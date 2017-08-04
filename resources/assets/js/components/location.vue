<script>
    // Componenets
    import panel from './panel'
    import rsInput from './forms/input'
    import rsSelect from './forms/select'
    import rsTextarea from './forms/textarea'
    import rsDatepicker from './forms/datepicker'
    import veeValidate from 'vee-validate' //http://vee-validate.logaretm.com/

    export default {
        name: 'location',

        data(){
            return {
                
            }
        },
        computed: {
            imageOptions() {
                return [
                    {value: '1', text: 'Option 1'},
                    {value: '2', text: 'Option 2'},
                    {value: '3', text: 'Option 3'}
                ];
            }
        },
        components: {
            panel,
            rsInput,
            rsSelect, 
            rsTextarea,
            rsDatepicker,
            veeValidate
        }
    }
</script>

<template>

    <panel title="Location">

        <div id="map">
            <div id="markerMenu" style="display: none;"></div>
        </div>

        <form>
            <rs-input label="Name" name="name"></rs-input>
            <rs-select label="Country" name="country"></rs-select>
            <rs-datepicker label="Visit date" name="visit_date"></rs-datepicker>
            <rs-select label="Image" name="image" :options="imageOptions"></rs-select>
            <rs-select label="Map" name="map"></rs-select>
            <rs-textarea label="Description" name="description"></rs-textarea>
            <md-button class="md-raised md-primary">Create</md-button>

            <input type="hidden" name="google_place_id" value="">
            <input type="hidden" name="lat" value="">
            <input type="hidden" name="lng" value="">
        </form>

    </panel>

</template>