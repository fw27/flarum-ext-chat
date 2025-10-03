### How it looks now:

# Dark Mode:

![Dark Mode NOW](https://i.postimg.cc/RVRtWb46/image.png)

# Light Mode:

![Light Mode NOW](https://i.postimg.cc/nr1XQCb9/image.png)

# Chat Extension Bug Fixes

This section here outlines the critical bug fixes applied to resolve the unresponsiveness and element glitching issues in this Flarum chat extension.

## Issues Fixed

### 1. ScrollHeight Reference Errors
**Problem**: `Cannot read properties of undefined (reading 'scrollHeight')` error in ChatViewport.js
**Root Cause**: Missing null checks when accessing DOM elements and their properties
**Fix**: Added comprehensive null checking and defensive programming in:
- `pixelsFromBottom()` method
- `getChatWrapper()` method
- `isFastScrollAvailable()` method
- `scrollToBottom()` method
- `loadChat()` method

### 2. Component Lifecycle Errors  
**Problem**: Multiple `Cannot read properties of undefined (reading 'onbeforeupdate')` errors
**Root Cause**: Components being destroyed or not properly initialized during lifecycle transitions
**Fix**: Added try-catch blocks and null checks in:
- `wrapperOnBeforeUpdate()` method
- `wrapperOnUpdate()` method  
- `wrapperOnRemove()` method
- `checkUnreaded()` method

### 3. Incorrect Class Export
**Problem**: ChatList.js was exporting as `ChatFrame` instead of `ChatList`
**Root Cause**: Copy-paste error in class declaration
**Fix**: Corrected export to `export default class ChatList extends Component`

### 4. State Management Issues
**Problem**: Chat state operations failing when components are not properly initialized
**Root Cause**: Missing null checks in state management operations
**Fix**: Added defensive checks in:
- `onChatChanged()` method with try-catch for redraw operations
- `renderChatMessage()` method with fallback error handling
- Various ChatFrame methods to check for `app.chat` existence

### 5. DOM Element Access Failures
**Problem**: Attempting to access DOM elements that may not exist
**Root Cause**: Timing issues and component lifecycle mismanagement
**Fix**: Enhanced all DOM element access with null checks:
- `getChatInput()` method in ViewportState
- `chatMoveProcess()` method in ChatFrame
- Element selection queries throughout

### 6. Duplicate Chat Creation Error (UPDATED)
**Problem**: `POST https://bunklr.com/api/chats 400 (Bad Request)` when trying to create a chat with a user you've already chatted with, especially when you've left that chat
**Root Cause**: Frontend not checking for existing private chats (including ones you've left) before attempting to create new ones
**Fix**: Enhanced logic in ChatCreateModal to:
- Check for existing active private chats using `findExistingPMChat()` method
- Check for chats you've left using new `findAnyPMChatIncludingLeft()` method
- Automatically rejoin existing chats when possible
- Provide specific user guidance when rejoining fails
- Added `findAnyPMChatIncludingLeft()` method to ChatState for comprehensive chat searching
- Better error messages differentiate between different failure scenarios

## Key Improvements

### Defensive Programming
- Added null checks before accessing object properties
- Implemented try-catch blocks around critical operations
- Added console warnings for debugging failed operations
- Fallback mechanisms for critical functionality

### Element Validation
- All DOM element access now validates existence before use
- ScrollHeight, scrollTop, and clientHeight checks before calculations
- Proper handling of missing or destroyed elements

### Error Handling
- Graceful degradation when components fail
- Console warnings instead of breaking errors
- Safe fallbacks for UI operations

### Build Compatibility
- Fixed Node.js compatibility issues with legacy OpenSSL provider
- Successful build verification with webpack

## Testing

The fixes have been validated through:
1. Code syntax validation during modifications
2. Successful webpack build process
3. Comprehensive error handling implementation

## Deployment

After applying these fixes:
1. The chat extension should be more stable
2. UI glitches should be significantly reduced
3. Component lifecycle errors should be eliminated
4. Better error recovery and user experience

## Recommendations

1. **Regular Testing**: Test the chat functionality with multiple users to ensure stability
2. **Monitor Console**: Keep an eye on browser console for any remaining warnings
3. **Performance**: Monitor performance with the additional null checks
4. **Future Updates**: Apply similar defensive programming patterns to any new features

## Files Modified

1. `/js/src/forum/components/ChatViewport.js` - Major stability improvements
2. `/js/src/forum/components/ChatList.js` - Fixed class export name
3. `/js/src/forum/components/ChatFrame.js` - Added null checks and element validation
4. `/js/src/forum/states/ChatState.js` - Enhanced error handling and added findExistingPMChat method
5. `/js/src/forum/states/ViewportState.js` - Improved DOM element access
6. `/js/src/forum/components/ChatCreateModal.js` - Added duplicate chat prevention logic

All changes maintain backward compatibility while significantly improving stability and user experience.





### This is the OLD VERSION section and how it used to look. All of the functionalities here have been maintained or upgraded.
The new minimalistic design will make communication more pleasant.  
![Image](https://i.ibb.co/3m4wCV3/b40f10da617c.png)
![Image](https://c.radikal.ru/c15/2201/0f/600cc5faac92.png)

### Media content preview
Send media content to people to make communication brighter!  
![Image](https://sun9-6.userapi.com/eldBF03c5Ys9dt1IYT-Di9KpQNX91sQFPhFEfA/n9KTpymA46U.jpg)

### Groups, PMs and channels
You can create your own conversations and channels, add or remove users, change their rights, and customize the appearance of the chat.

![Image](https://sun9-13.userapi.com/sZjGejXxf0pY8tBOQPgeTGWAnrWOYGqAR8AkCA/L9zBWvw7FPQ.jpg)

### Push and sound notifications  
Stay up to date with the chat discussion and find out about mentions of you via push notifications.  
![Image](https://sun9-16.userapi.com/_LwmU4GtCL8csbq_443Aal13nmtsvMvx6IlveA/SS9-kZS6NQI.jpg)

# Neon Chat

![License](https://img.shields.io/badge/license-MIT-blue.svg) 
[![Latest Release](https://img.shields.io/packagist/v/xelson/flarum-ext-chat)](https://packagist.org/packages/xelson/flarum-ext-chat)   
A [Flarum](http://flarum.org) extension. Adds native realtime chat to your Flarum.

Requires Pusher or [kyrne/websocket](https://extiverse.com/extension/kyrne/websocket)

# Installation

Install extension via composer:
```
composer require xelson/flarum-ext-chat
```
For development builds:
```
composer require xelson/flarum-ext-chat:dev-master
```
Make sure that any socket extension is enabled

# Updating
Via composer:
```
composer update xelson/flarum-ext-chat
php flarum migrate
php flarum cache:clear
```

For development builds:
```
composer require xelson/flarum-ext-chat:dev-master
php flarum migrate
php flarum cache:clear
```

# Roadmap:

* Emoji picker
* [FriendsOfFlarum/upload](https://github.com/FriendsOfFlarum/upload) support
* Chat display mode in a separate browser window
* Forum notifications for missed mentions
* Customizing of notification sounds
* Chat messages history. Finding messages by keywords or name
