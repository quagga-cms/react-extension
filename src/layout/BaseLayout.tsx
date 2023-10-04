import React, { PureComponent } from 'preact/compat';
import { Attributes, ComponentChildren, Ref, ComponentChild } from 'preact';

declare global {
  // tslint:disable-next-line: interface-name
  interface Window {
  }
}

class BaseLayout extends PureComponent {
  render(props?: Readonly<Attributes & { children?: ComponentChildren; ref?: Ref<any> | undefined; }> | undefined, state?: Readonly<{}> | undefined, context?: any): ComponentChild {
    return (
        <div>BaseLayout</div>
    );
  }
}

export default BaseLayout;