import Vue from 'vue';
import { Route } from 'vue-router';
import { DispatchOptions } from 'vuex';

export const callbackGenerator = function(
  next: (to?: string|false|Route|((vm: Vue) => void)) => void,
  action: string,
  payload?: any,
  options?: DispatchOptions
) {
  return (vm: Vue) => {
    vm.$store.dispatch('wait');
    vm.$store.dispatch(action, payload, options).then(() => {
      vm.$store.dispatch('resolveWait');
      next();
    }).catch((e) => {
      console.error(e);
      vm.$store.dispatch('resolveWait');
      next(false);
    });
  }
};

export const RouteGuardGenerator = function(
  action: string,
  options?: DispatchOptions
) {
  return function(
    this: Vue,
    to: Route,
    from: Route,
    next: (to?: string|false|Route|((vm: Vue) => void)) => void
  ) {
    if (to.params.id === undefined) {
      next(false);
    }

    const callback = callbackGenerator(next, action, to.params.id, options);

    if (this === undefined) {
      next(callback);
    } else {
      callback(this);
    }
  }
}
