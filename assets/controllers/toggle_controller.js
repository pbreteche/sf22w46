import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['toggleElt']

    toggleAction() {
        this.toggleEltTarget.hidden = !this.toggleEltTarget.hidden;
    }
}
