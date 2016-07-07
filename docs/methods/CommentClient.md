# Class CommentClient
```
@package vipnytt\RobotsTxtParser\Client\Directives
```

### Directives:
- [Comment](../directives.md#comment)

## Public functions
- [export](#export)
- [get](#get)
- [__destruct](#__destruct)

### export
```
@return array
```
Export an array of comments for the matching user-agent.

### get
```
@return string[]
```
Get any comments for the matching user-agent.

### __destruct
If there exists any comments for the matching user-agent, witch has not been fetched, AND the matching user-agent IS NOT `*`, every comment will trigger as E_USER_NOTICE.