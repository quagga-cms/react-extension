import React from 'preact/compat';
import { Attributes, ComponentChildren, Ref, ComponentChild } from 'preact';
import BaseLayout from './BaseLayout';

declare global {
  // tslint:disable-next-line: interface-name
  interface Window {
  }
}

class OnlyContent extends BaseLayout {
  render(props?: Readonly<Attributes & { children?: ComponentChildren; ref?: Ref<any> | undefined; }> | undefined, state?: Readonly<{}> | undefined, context?: any): ComponentChild {
    return (
        <div>OnlyContent</div>
    );
  }
}

export default OnlyContent;